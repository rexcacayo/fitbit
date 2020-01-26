<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateheartRateRequest;
use App\Http\Requests\UpdateheartRateRequest;
use App\Repositories\heartRateRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\fitbit;
use Carbon\Carbon;
use App\Models\heartRate;

class heartRateController extends AppBaseController
{
    /** @var  heartRateRepository */
    private $heartRateRepository;

    public function __construct(heartRateRepository $heartRateRepo)
    {
        $this->heartRateRepository = $heartRateRepo;
    }

    /**
     * Display a listing of the heartRate.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $heartRates = $this->heartRateRepository->all();

        return view('heart_rates.index')
            ->with('heartRates', $heartRates);
    }

    /**
     * Show the form for creating a new heartRate.
     *
     * @return Response
     */
    public function create()
    {
        $fitbitZone = ['OutofRange' => 'OutofRange','FatBurn' => 'FatBurn','Cardio' => 'Cardio','Peak' => 'Peak', 'all' => 'all'];
        $fitbitUser = fitbit::pluck('name','user_id');
        $startDate = new Carbon('yesterday');
        $endDate = Carbon::now();
        return view('heart_rates.create')->with('fitbitUser', $fitbitUser)->with('fitbitZone',$fitbitZone)->with('endDate', $endDate)->with('startDate', $startDate);
    }

    /**
     * Store a newly created heartRate in storage.
     *
     * @param CreateheartRateRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $dateStart = $input['dateStart']."T00:00:00.000";
        $dateEnd = $input['dateEnd']."T23:59:59.000";
        $rango = "Desde: ".$input['dateStart']."  Hasta: ".$input['dateEnd'];
        //$transmisor = str_replace(':', '_', $input['transmisor']);
        //$transmisor = str_replace('/', '', $transmisor);
        $datos = heartRate::where('attrValue', '=', $input['zone'])->whereBetween('recvTime', array($dateStart, $dateEnd ))->get('recvTimeTs');
/////////ERROR SIN DATOS//////////////////
        foreach($datos as $data){
            $datos_list['calories'][] = heartRate::where('recvTimeTs','=',$data->recvTimeTs)->where('attrName','=','caloriesOut')->get('attrValue')->toArray();
            $datos_list['minutes'][] = heartRate::where('recvTimeTs','=',$data->recvTimeTs)->where('attrName','=','minutes')->get('attrValue')->toArray();
        }

        $rango = "Desde: ".$input['dateStart']."  Hasta: ".$input['dateEnd'];
        $total = count($datos_list['calories']);
        for($i=0; $i<$total; $i++){
            $dataV[$i]['x'] = $datos_list['calories'][$i][0]['attrValue'];
            $dataV[$i]['y'] = $datos_list['minutes'][$i][0]['attrValue'];
        }

        return view('heart_rates.chart')->with('datos', $dataV)->with('rango', $rango)->with('zone',$input['zone']);

        /*$heartRate = $this->heartRateRepository->create($input);

        Flash::success('Heart Rate saved successfully.');

        return redirect(route('heartRates.index'));*/
    }

    /**
     * Display the specified heartRate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $heartRate = $this->heartRateRepository->find($id);

        if (empty($heartRate)) {
            Flash::error('Heart Rate not found');

            return redirect(route('heartRates.index'));
        }

        return view('heart_rates.show')->with('heartRate', $heartRate);
    }

    /**
     * Show the form for editing the specified heartRate.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $heartRate = $this->heartRateRepository->find($id);

        if (empty($heartRate)) {
            Flash::error('Heart Rate not found');

            return redirect(route('heartRates.index'));
        }

        return view('heart_rates.edit')->with('heartRate', $heartRate);
    }

    /**
     * Update the specified heartRate in storage.
     *
     * @param int $id
     * @param UpdateheartRateRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateheartRateRequest $request)
    {
        $heartRate = $this->heartRateRepository->find($id);

        if (empty($heartRate)) {
            Flash::error('Heart Rate not found');

            return redirect(route('heartRates.index'));
        }

        $heartRate = $this->heartRateRepository->update($request->all(), $id);

        Flash::success('Heart Rate updated successfully.');

        return redirect(route('heartRates.index'));
    }

    /**
     * Remove the specified heartRate from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $heartRate = $this->heartRateRepository->find($id);

        if (empty($heartRate)) {
            Flash::error('Heart Rate not found');

            return redirect(route('heartRates.index'));
        }

        $this->heartRateRepository->delete($id);

        Flash::success('Heart Rate deleted successfully.');

        return redirect(route('heartRates.index'));
    }
}
