<?php

namespace App\Http\Controllers;

use App\Repositories\fiwareRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\iotService;
use App\Models\fiware;
use App\Models\iot_device;
use App\Models\User;
use Illuminate\Http\Request;
use Flash;
use Response;
use Log;
use Khill\Lavacharts\Lavacharts;


class fiwareController extends AppBaseController
{

    /** @var  fiwareRepository */
    private $fiwareRepository;

    public function __construct(fiwareRepository $fiwareRepo)
    {
        $this->fiwareRepository = $fiwareRepo;
    }

    /**
     * Display a listing of the fiware.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //
    }

    public function form()
    {

        $spa = iotService::pluck('fiwarePath','fiwarePath');
        return view('temperatura.form')->with('spa', $spa);
    }

    public function consulta(Request $request)
    {

        $input = $request->all();
        if($input['fiwarePath'] === "null"){

            Flash::error('Error: Debe llenar los campos','Error');
            $spa = iotService::pluck('fiwarePath','fiwarePath');
            return view('temperatura.form')->with('spa', $spa);

        }
        if($input['transmisor'] === "placeholder"){

            Flash::error('Error: Debe llenar los campos','Error');
            $spa = iotService::pluck('fiwarePath','fiwarePath');
            return view('temperatura.form')->with('spa', $spa);

        }

        $dateStart = $input['dateStart']."T00:00:00.000";
        $dateEnd = $input['dateEnd']."T23:59:59.000";
        $rango = "Desde: ".$input['dateStart']."  Hasta: ".$input['dateEnd'];
        $transmisor = str_replace(':', '_', $input['transmisor']);
        $transmisor = str_replace('/', '', $transmisor);
        $datos = fiware::nombreTabla($transmisor)
            ->whereBetween('recvTime', array($dateStart, $dateEnd ))->where('attrName','=','temperatura')->get(array('attrValue','recvTime'));
            return view('temperatura.chart')->with('datos', $datos)->with('rango', $rango);
    }

    public function getSensores(Request $request, $nombre){
        if($request->ajax()){
            $nombre = '/'.$nombre;
            $sensores = iot_device::where('fiwarePath', '=', $nombre)->get();
            return response($sensores);
        }
    }

    //PRESION

    public function formPresion()
    {
        $spa = iotService::pluck('fiwarePath','fiwarePath');
        return view('presion.form')->with('spa', $spa);
    }

    public function consultaPresion(Request $request)
    {
        $input = $request->all();
        if($input['fiwarePath'] === "null"){

            Flash::error('Error: Debe llenar los campos','Error');
            $spa = iotService::pluck('fiwarePath','fiwarePath');
            return view('temperatura.form')->with('spa', $spa);

        }
        if($input['transmisor'] === "placeholder"){

            Flash::error('Error: Debe llenar los campos','Error');
            $spa = iotService::pluck('fiwarePath','fiwarePath');
            return view('temperatura.form')->with('spa', $spa);

        }

        $dateStart = $input['dateStart']."T00:00:00.000";
        $dateEnd = $input['dateEnd']."T23:59:59.000";
        $rango = "Desde: ".$input['dateStart']."  Hasta: ".$input['dateEnd'];
        $transmisor = str_replace(':', '_', $input['transmisor']);
        $transmisor = str_replace('/', '', $transmisor);
        $datos = fiware::nombreTabla($transmisor)
            ->whereBetween('recvTime', array($dateStart, $dateEnd ))->where('attrName','=','presion')->get(array('attrValue','recvTime'));
            return view('presion.chart')->with('datos', $datos)->with('rango', $rango);


    }

    public function getSensoresPresion(Request $request, $nombre){
        if($request->ajax()){
            $nombre = '/'.$nombre;
            $sensores = iot_device::where('fiwarePath', '=', $nombre)->get();
            return response($sensores);
        }
    }

    //HUMEDAD

    public function formHumedad()
    {
        $spa = iotService::pluck('fiwarePath','fiwarePath');
        return view('humedad.form')->with('spa', $spa);
    }

    public function consultaHumedad(Request $request)
    {
        $input = $request->all();
        if($input['fiwarePath'] === "null"){

            Flash::error('Error: Debe llenar los campos','Error');
            $spa = iotService::pluck('fiwarePath','fiwarePath');
            return view('temperatura.form')->with('spa', $spa);

        }
        if($input['transmisor'] === "placeholder"){

            Flash::error('Error: Debe llenar los campos','Error');
            $spa = iotService::pluck('fiwarePath','fiwarePath');
            return view('temperatura.form')->with('spa', $spa);

        }

        $dateStart = $input['dateStart']."T00:00:00.000";
        $dateEnd = $input['dateEnd']."T23:59:59.000";
        $rango = "Desde: ".$input['dateStart']."  Hasta: ".$input['dateEnd'];
        $transmisor = str_replace(':', '_', $input['transmisor']);
        $transmisor = str_replace('/', '', $transmisor);
        $datos = fiware::nombreTabla($transmisor)
            ->whereBetween('recvTime', array($dateStart, $dateEnd ))->where('attrName','=','humedad')->get(array('attrValue','recvTime'));
            return view('humedad.chart')->with('datos', $datos)->with('rango', $rango);


    }

    public function getSensoresHumedad(Request $request, $nombre){
        if($request->ajax()){
            $nombre = '/'.$nombre;
            $sensores = iot_device::where('fiwarePath', '=', $nombre)->get();
            return response($sensores);
        }
    }


}
