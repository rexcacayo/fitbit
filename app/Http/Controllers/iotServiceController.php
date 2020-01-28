<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateiotServiceRequest;
use App\Http\Requests\UpdateiotServiceRequest;
use App\Repositories\iotServiceRepository;
use App\Models\iotService;
use App\Models\iot_device_attribute;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Flash;
use Response;
use Log;
use Illuminate\Support\Facades\DB;

class iotServiceController extends AppBaseController
{
    /** @var  iotServiceRepository */
    private $iotServiceRepository;

    public function __construct(iotServiceRepository $iotServiceRepo)
    {
        $this->iotServiceRepository = $iotServiceRepo;
    }

    /**
     * Display a listing of the iotService.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $iotServices = $this->iotServiceRepository->all();

        return view('iot_services.index')
            ->with('iotServices', $iotServices);
    }

    /**
     * Show the form for creating a new iotService.
     *
     * @return Response
     */
    public function create()
    {
        $fiwarepath = '/';
        $resource = '/iot/d';
        return view('iot_services.create')->with('fiwarepath', $fiwarepath)->with('resource', $resource);
    }

    /**
     * Store a newly created iotService in storage.
     *
     * @param CreateiotServiceRequest $request
     *
     * @return Response
     */
    public function store(CreateiotServiceRequest $request)
    {

        $input = $request->all();

        $ip = config('fiware.fiware_servidor_ip');
        $service = config('fiware.fiware_service');
        $path = '/';
        $entity = ucfirst($input['entity_type']);
        $apikey = $input['apikey'];
        $resource = $input['resource'];
        $portIOT = config('fiware.fiware_iot_port');
        $portOrion = config('fiware.fiware_orion_port');
        $url = "http://$ip:$portIOT/iot/services";
        $urlC = "http://$ip:$portOrion";
        $campos= $input['attrName'];
        $camposTipo = $input['attrType'];
        $camposObjective = $input['attrObject'];
        $camposTamano = count($campos);

        $cadena = "CREATE TABLE $entity(";
        $cadena.="recvTimeTs varchar(191) null, recvTime varchar(191) null, fiwareServicePath varchar(191) null,";
        $cadena.="entityId varchar(191) null, entityType varchar(191) null, attrName varchar(191) null,";
        $cadena.="attrType varchar(191) null, attrValue varchar(191) null, attrMd varchar(191) null";
        $cadena .= ")";

        try{
            $results=DB::statement($cadena);
        }
        catch(\Exception $e){
            Flash::success('Persistencia de datos: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
            \Log::error('Persistencia de datos: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
            return redirect(route('iotServices.index'));
        }

        try{
            $data =
                '{
                    "services": [
                      {
                        "apikey": "'.$apikey.'",
                        "cbroker": "http://'.config('fiware.fiware_orion_ip').':'.$portOrion.'",
                        "entity_type": "'.$entity.'",
                        "resource": "'.$resource.'"
                      }
                    ]
                  }';

            $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $headers = [

                    "Content-Type:application/json",

                    "fiware-service:$service" ,

                    "fiware-servicepath:$path",

            ];

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec ($ch);
            $err = curl_error($ch);
            curl_close ($ch);
            $answer = json_decode($server_output);
            if(!empty($answer->name)){
               // $cadenaError = "DROP TABLE. $entity.";
              //  $results=DB::statement($cadenaError);
                Flash::success('Datos a corto plazo: ' . $answer->name . ', Mensaje ' . $answer->message);
                \Log::error('Datos a corto plazo: ' . $answer->name . ', Mensaje ' . $answer->message);
                return redirect(route('iotServices.index'));
            }else{
                $iotGroup = new iotService;
                $iotGroup->ipServer = $ip;
                $iotGroup->fiwareService = $service;
                $iotGroup->fiwarePath = $path;
                $iotGroup->apikey = $apikey;
                $iotGroup->cbroker = $urlC;
                $iotGroup->entity_type = $entity;
                $iotGroup->resource = $resource;
                $iotGroup->save();
                for($i=0;$i<$camposTamano; $i++){

                    $atributo = new iot_device_attribute;
                    $atributo->name = $campos[$i];
                    $atributo->type = $camposTipo[$i];
                    $atributo->objective = $camposObjective[$i];
                    $atributo->attr_id = $iotGroup->id;

                    $atributo->save();
                }
            }
                Flash::success('Grupo IOT creado');
                return redirect(route('iotServices.index'));
        }

        catch(\Exception $e){
            //$cadenaError = "'DROP TABLE'.$entity.'";
            //$results=DB::statement($cadenaError);
            Log::critical('SERVICIO: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
            \Log::error('SERVICIO: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
                Flash::success('SERVICIO: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
                return redirect(route('iotServices.index'));
            }




    }

    /**
     * Display the specified iotService.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iotService = $this->iotServiceRepository->find($id);

        if (empty($iotService)) {
            Flash::error('Iot Service not found');

            return redirect(route('iotServices.index'));
        }

        return view('iot_services.show')->with('iotService', $iotService);
    }

    /**
     * Show the form for editing the specified iotService.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iotService = $this->iotServiceRepository->find($id);

        if (empty($iotService)) {
            Flash::error('Iot Service not found');

            return redirect(route('iotServices.index'));
        }

        return view('iot_services.edit')->with('iotService', $iotService);
    }

    /**
     * Update the specified iotService in storage.
     *
     * @param int $id
     * @param UpdateiotServiceRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateiotServiceRequest $request)
    {
        $iotService = $this->iotServiceRepository->find($id);

        if (empty($iotService)) {
            Flash::error('Iot Service not found');

            return redirect(route('iotServices.index'));
        }

        $iotService = $this->iotServiceRepository->update($request->all(), $id);

        Flash::success('Iot Service updated successfully.');

        return redirect(route('iotServices.index'));
    }

    /**
     * Remove the specified iotService from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iotService = $this->iotServiceRepository->find($id);

        if (empty($iotService)) {
            Flash::error('Iot Service not found');

            return redirect(route('iotServices.index'));
        }

        $urlD = "http://$iotService->ipServer:4041/iot/services/?resource=$iotService->resource&apikey=$iotService->apikey";
        $fiwareService =  $iotService->fiwareService;
        $fiwarePath =  $iotService->fiwarePath;

        $headers = [
            "fiware-service:$fiwareService" ,
            "fiware-servicepath:$fiwarePath",
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlD);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);
        curl_close ($ch);

    /**fin */


        $this->iotServiceRepository->delete($id);

        Flash::success('Iot Service deleted successfully.');

        return redirect(route('iotServices.index'));
    }
}
