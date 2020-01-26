<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatefitbitRequest;
use App\Http\Requests\UpdatefitbitRequest;
use App\Repositories\fitbitRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Carbon\Carbon;
use App\Models\iotService;
use App\Models\iot_device;
use App\Models\fitbit;



class fitbitController extends AppBaseController
{
    /** @var  fitbitRepository */
    private $fitbitRepository;

    public function __construct(fitbitRepository $fitbitRepo)
    {
        $this->fitbitRepository = $fitbitRepo;
    }

    /**
     * Display a listing of the fitbit.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $fitbits = $this->fitbitRepository->all();

        return view('fitbits.index')
            ->with('fitbits', $fitbits);
    }

    /**
     * Show the form for creating a new fitbit.
     *
     * @return Response
     */
    public function create()
    {
        return view('fitbits.create');
    }

    /**
     * Store a newly created fitbit in storage.
     *
     * @param CreatefitbitRequest $request
     *
     * @return Response
     */
    public function store(CreatefitbitRequest $request)
    {
        $input = $request->all();

        $fitbit = $this->fitbitRepository->create($input);

        Flash::success('Fitbit saved successfully.');

        return redirect(route('fitbits.index'));
    }

    /**
     * Display the specified fitbit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $fitbit = $this->fitbitRepository->find($id);

        if (empty($fitbit)) {
            Flash::error('Fitbit not found');

            return redirect(route('fitbits.index'));
        }

        return view('fitbits.show')->with('fitbit', $fitbit);
    }

    /**
     * Show the form for editing the specified fitbit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $fitbit = $this->fitbitRepository->find($id);

        if (empty($fitbit)) {
            Flash::error('Fitbit not found');

            return redirect(route('fitbits.index'));
        }

        return view('fitbits.edit')->with('fitbit', $fitbit);
    }

    /**
     * Update the specified fitbit in storage.
     *
     * @param int $id
     * @param UpdatefitbitRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatefitbitRequest $request)
    {
        $fitbit = $this->fitbitRepository->find($id);

        if (empty($fitbit)) {
            Flash::error('Fitbit not found');

            return redirect(route('fitbits.index'));
        }

        $fitbit = $this->fitbitRepository->update($request->all(), $id);

        Flash::success('Fitbit updated successfully.');

        return redirect(route('fitbits.index'));
    }

    /**
     * Remove the specified fitbit from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $fitbit = $this->fitbitRepository->find($id);

        if (empty($fitbit)) {
            Flash::error('Fitbit not found');

            return redirect(route('fitbits.index'));
        }

        $this->fitbitRepository->delete($id);

        Flash::success('Fitbit deleted successfully.');

        return redirect(route('fitbits.index'));
    }

    public function syncup()
    {
        $date = new Carbon('yesterday');
        $dateF = $date->format('Y-m-d');
        $ip = config('fiware.fiware_servidor_ip');
        $iotSerHeartZone = iotService::where('entity_type','zone')->get();

        $iotSerHeartInt = iotService::where('entity_type','diary')->get();

        if($iotSerHeartZone->isNotEmpty()){
            $apiHeartZone = $iotSerHeartZone[0]['apikey'];
        }

        if($iotSerHeartInt->isNotEmpty()){
            $apiHeartInt = $iotSerHeartInt[0]['apikey'];
        }

        $userSensor = iot_device::all();

        foreach($userSensor as $sensor){
            $userFitbitP[] = str_replace(strtolower($sensor['entity_type']),"",$sensor['device_id']);
        }

        $userFitbit = array_values(array_unique($userFitbitP));

        foreach($userFitbit as $fitbit){
            $urlHeartRate = "https://api.fitbit.com/1/user/$fitbit/activities/heart/date/$dateF/1d/1min.json";
            $token = fitbit::where('user_id', $fitbit)->get('token')->toArray();
            $apikey = $token[0]['token'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlHeartRate);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = [
                "Content-Type:application/json",
                "Authorization: Bearer $apikey",
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec ($ch);
            $err = curl_error($ch);
            curl_close ($ch);
            $data = json_decode($server_output, true);
            $data_zone = $data['activities-heart'][0]['value']['heartRateZones'];
            $data_inter = $data['activities-heart-intraday']['dataset'];

            //TRANSFERENCIA A FIWARE/////////////////////////////////////////////////////////////////

            foreach($data_zone as $zone){
                if($zone['caloriesOut'] != "0"){
                    $urlFiwareHeart = "http://45.32.187.7:7896/iot/d?k=$apiHeartZone&i=zone$fitbit";
                    $c = $zone['caloriesOut'];
                    $m = $zone['minutes'];
                    $n = str_replace(' ', '', $zone['name']);
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,            $urlFiwareHeart );
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                    curl_setopt($ch, CURLOPT_POST,           1 );
                    curl_setopt($ch, CURLOPT_POSTFIELDS,     "c|$c|m|$m|n|$n" );
                    curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                    curl_setopt($ch, CURLOPT_TIMEOUT,        10);
                    $result[]=curl_exec ($ch);
                    $err = curl_error($ch);
                    curl_close ($ch);
                }
                unset($ch,$result,$err,$c,$m,$n);
            }

            ////////////////////////////////ZONAS///////////////////////////////////////////////////
            //unset($data,$data_zone,$ch,$result,$err,$c,$m,$n,$u,$e);

            $urlFiwareHeartInter = "http://$ip:7896/iot/d?k=$apiHeartInt&i=diary$fitbit";
            $totalReg = count($data_inter);

            for($i=0;$i<$totalReg;$i++){
                $v = $data_inter[$i]['value'];
                $t = $data_inter[$i]['time'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $urlFiwareHeartInter );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "t|$t|v|$v" );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                $result = curl_exec ($ch);
                $err = curl_error($ch);
                curl_close ($ch);

            }



        }
        return redirect(route('fitbits.index'));
    }

    public function syncupSleep()
    {
        $date = new Carbon('yesterday');
        $dateF = $date->format('Y-m-d');
        $ip = config('fiware.fiware_servidor_ip');
        $iotSerSleep = iotService::where('entity_type','Sleep')->get();
        $iotSerSummary = iotService::where('entity_type','Summary')->get();

        if($iotSerSleep->isNotEmpty()){
            $apiSleep = $iotSerSleep[0]['apikey'];
        }

        if($iotSerSummary->isNotEmpty()){
            $apiSummary = $iotSerSummary[0]['apikey'];
        }

        $userSensor = iot_device::all();

        foreach($userSensor as $sensor){
            $userFitbitP[] = str_replace(strtolower($sensor['entity_type']),"",$sensor['device_id']);
        }

        $userFitbit = array_values(array_unique($userFitbitP));

        foreach($userFitbit as $fitbit){
            $urlSleep = "https://api.fitbit.com/1.2/user/$fitbit/sleep/date/$dateF.json";
            $token = fitbit::where('user_id', $fitbit)->get('token')->toArray();
            $apikey = $token[0]['token'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $urlSleep);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = [
                "Content-Type:application/json",
                "Authorization: Bearer $apikey",
            ];
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec ($ch);
            $err = curl_error($ch);
            curl_close ($ch);
            $data = json_decode($server_output, true);
            $totalSleepRecords = $data['summary']['totalSleepRecords'];

            $i=$totalSleepRecords;
            while (0 < $i) {
                $i = $i - 1;
                $datos[]=$data['sleep'][$i]['levels']['data'];
                $datos2[]=$data['sleep'][$i]['levels']['summary'];
            }

            $totalDatos = count($datos);
            for($i=0; $i < $totalDatos; $i++){
                $totalInt = count($datos[$i]);
                for($j=0; $j < $totalInt; $j++){
                    $dat['level'][] = $datos[$i][$j]['level'];
                    $dat['dateTime'][] = $datos[$i][$j]['dateTime'];
                    $dat['seconds'][] = $datos[$i][$j]['seconds'];
                }
            }
            $totalFiware = count($dat['level']);

            for($x=0; $x < $totalFiware; $x++){
                sleep(5);
                $s = $dat['level'][$x];
                $l = $dat['dateTime'][$x];
                $d = $dat['seconds'][$x];
                $urlFiwareSleep = "http://$ip:7896/iot/d?k=$apiSleep&i=sleep$fitbit";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $urlFiwareSleep );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "l|$s|s|$l|d|$d" );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                curl_setopt($ch, CURLOPT_TIMEOUT,        1);
                $result[]=curl_exec ($ch);
                $err = curl_error($ch);
                curl_close ($ch);
            }


            ///****************SUMARY*****///
            foreach ($datos2 as $dat2) {
                sleep(5);
                $t = $dat2['deep']['count'];
                $g = $dat2['deep']['minutes'];
                $v = $dat2['deep']['thirtyDayAvgMinutes'];
                $x = 'deep';

                $urlFiwareSummary = "http://$ip:7896/iot/d?k=$apiSummary&i=summary$fitbit";

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $urlFiwareSummary );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "t|$t|g|$g|v|$v|x|$x" );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                curl_setopt($ch, CURLOPT_TIMEOUT,        1);
                $result[]=curl_exec ($ch);
                $err = curl_error($ch);
                curl_close ($ch);

                $t = $dat2['light']['count'];
                $g = $dat2['light']['minutes'];
                $v = $dat2['light']['thirtyDayAvgMinutes'];
                $x = 'light';
                $urlFiwareSummary = "http://$ip:7896/iot/d?k=$apiSummary&i=summary$fitbit";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $urlFiwareSummary );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "t|$t|g|$g|v|$v|x|$x" );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                curl_setopt($ch, CURLOPT_TIMEOUT,        1);
                $result[]=curl_exec ($ch);
                $err = curl_error($ch);
                curl_close ($ch);

                $t = $dat2['rem']['count'];
                $g = $dat2['rem']['minutes'];
                $v = $dat2['rem']['thirtyDayAvgMinutes'];
                $x = 'rem';
                $urlFiwareSummary = "http://$ip:7896/iot/d?k=$apiSummary&i=summary$fitbit";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $urlFiwareSummary );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "t|$t|g|$g|v|$v|x|$x" );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                curl_setopt($ch, CURLOPT_TIMEOUT,        1);
                $result[]=curl_exec ($ch);
                $err = curl_error($ch);
                curl_close ($ch);

                $t = $dat2['wake']['count'];
                $g = $dat2['wake']['minutes'];
                $v = $dat2['wake']['thirtyDayAvgMinutes'];
                $x = 'wake';
                $urlFiwareSummary = "http://$ip:7896/iot/d?k=$apiSummary&i=summary$fitbit";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,            $urlFiwareSummary );
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
                curl_setopt($ch, CURLOPT_POST,           1 );
                curl_setopt($ch, CURLOPT_POSTFIELDS,     "t|$t|g|$g|v|$v|x|$x" );
                curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));
                curl_setopt($ch, CURLOPT_TIMEOUT,        1);
                $result[]=curl_exec ($ch);
                $err = curl_error($ch);
                curl_close ($ch);


            }






        }
        return redirect(route('fitbits.index'));
    }
}
