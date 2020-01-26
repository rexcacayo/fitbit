<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createiot_deviceRequest;
use App\Http\Requests\Updateiot_deviceRequest;
use App\Repositories\iot_deviceRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\iot_device_attribute;
use Log;
use App\Models\iotService;
use App\Models\iot_device;
use App\Models\fitbit;

class iot_deviceController extends AppBaseController
{
    /** @var  iot_deviceRepository */
    private $iotDeviceRepository;

    public function __construct(iot_deviceRepository $iotDeviceRepo)
    {
        $this->iotDeviceRepository = $iotDeviceRepo;
    }

    /**
     * Display a listing of the iot_device.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $iotDevices = $this->iotDeviceRepository->all();

        return view('iot_devices.index')
            ->with('iotDevices', $iotDevices);
    }

    /**
     * Show the form for creating a new iot_device.
     *
     * @return Response
     */
    public function create()
    {
        $userId = fitbit::pluck('name','user_id');
        $conjunto = iotService::pluck('entity_type','entity_type');
        $spa = iotService::pluck('fiwarePath','fiwarePath');
        return view('iot_devices.create')->with('conjunto', $conjunto)->with('spa',$spa)->with('userId',$userId);
    }

    /**
     * Store a newly created iot_device in storage.
     *
     * @param Createiot_deviceRequest $request
     *
     * @return Response
     */
    public function store(Createiot_deviceRequest $request)
    {

        $input = $request->all();

        /***validar ip server  */
        try{

            /*proceso para crear entidada en mongo*/
            $fiwareService = config('fiware.fiware_service');
            $fiwarePath = $input['fiwarePath'];
            $ip = config('fiware.fiware_servidor_ip');
            $iotPort = config('fiware.fiware_iot_port');
            $url = "http://$ip:$iotPort/iot/devices";
            $deviceId = $input['device_id'];
            //$entityName = $input['entity_name'];
            $entityType = $input['entity_type'];
            $atributoObject = $input['attrObject'];
            $atributoNombre = $input['attrName'];
            $atributoTipo = $input['attrType'];
            $tamanoAtributo = count($atributoNombre);

            /*creacion de identidad*/

            $data['devices'][0]['device_id'] = strtolower($entityType).$deviceId;
            //$data['devices'][0]['entity_name'] = 'urn:ngsi-Id:'.ucfirst($entityType).':'.$deviceId;
            $data['devices'][0]['entity_name'] = 'urn:ngsi-Id:'.ucfirst($entityType);
            $data['devices'][0]['entity_type'] = ucfirst($entityType);
            $data['devices'][0]['timezone'] = config('fiware.fiware_timezone');

            for ($i=0;$i < $tamanoAtributo; $i++){

                $data['devices'][0]['attributes'][$i]['object_id'] = $atributoObject[$i];
                $data['devices'][0]['attributes'][$i]['name'] = $atributoNombre[$i];
                $data['devices'][0]['attributes'][$i]['type'] = $atributoTipo[$i];
            };

            $data['devices'][0]['static_attributes'][0]['name'] = "user_id";
            $data['devices'][0]['static_attributes'][0]['type'] = "Relationship";
            $data['devices'][0]['static_attributes'][0]['value'] = $deviceId;
            $data['devices'][0]['static_attributes'][1]['name'] = "continent";
            $data['devices'][0]['static_attributes'][1]['type'] = "Relationship";
            $data['devices'][0]['static_attributes'][1]['value'] = config('fiware.fiware_continent');
            $data['devices'][0]['static_attributes'][2]['name'] = "country";
            $data['devices'][0]['static_attributes'][2]['type'] = "Relationship";
            $data['devices'][0]['static_attributes'][2]['value'] = config('fiware.fiware_country');
            $data['devices'][0]['static_attributes'][3]['name'] = "city";
            $data['devices'][0]['static_attributes'][3]['type'] = "Relationship";
            $data['devices'][0]['static_attributes'][3]['value'] = config('fiware.fiware_city');
            $data['devices'][0]['static_attributes'][4]['name'] = "dock";
            $data['devices'][0]['static_attributes'][4]['type'] = "Relationship";
            $data['devices'][0]['static_attributes'][4]['value'] = config('fiware.fiware_dock');

            $data_json = json_encode($data);

            /************fin */
            $headers = [
                "Content-Type:application/json",
                "fiware-service:$fiwareService" ,
                "fiware-servicepath:$fiwarePath",
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $server_output = curl_exec ($ch);

            if($server_output === false)
            {
                Flash::error('Error Number:'.curl_errno($ch).',Error String:'.curl_error($ch) );
                curl_close ($ch);
                return redirect(route('iotDevices.create'))->withInput();
            }
            curl_close ($ch);

            $respuesta = json_decode($server_output);



            if(isset($respuesta->name)){


                Flash::error('Error:'.$respuesta->name.','.$respuesta->message);

                return redirect(route('iotDevices.create'))->withInput();

            }
        }

        catch(\Exception $e){
            Log::critical('No se pudo crear iot device: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
            return response('No se pudo crear iot device: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage(), 500);
        }
        $input['device_id'] = $entityType.$deviceId;
        $input['entity_name'] = 'urn:ngsis-Id:'.$entityType;

        $iotDevice = new iot_device;
        $iotDevice->ipServer = $ip;
        $iotDevice->fiwareService = $fiwareService;
        $iotDevice->fiwarePath = $fiwarePath;
        $iotDevice->device_id = strtolower($entityType).$deviceId;
        $iotDevice->entity_name = 'urn:ngsi-Id:'.ucfirst($entityType);
        $iotDevice->entity_type = $entityType;
        $iotDevice->save();


        //$iotDevice = $this->iotDeviceRepository->create($input);
        /*$iotDevice = $this->iotDeviceRepository->find($iotDevice->id);

        $attrName = $input['attrName'];
        $attrType = $input['attrType'];
        $attr = new iot_device_attribute;
        $i = 0;
        foreach ($attrName as $name) {
            $attr->name = $name;
            $attr->type = $attrType[$i];

            $iotDevice->atributoIOT()->save($attr);
            $i++;
            $attr = new iot_device_attribute;

        }*/

        Flash::success('Iot Device saved successfully.');

        return redirect(route('iotDevices.index'));
    }

    /**
     * Display the specified iot_device.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iotDevice = $this->iotDeviceRepository->find($id);

        if (empty($iotDevice)) {
            Flash::error('Iot Device not found');

            return redirect(route('iotDevices.index'));
        }

        return view('iot_devices.show')->with('iotDevice', $iotDevice);
    }

    /**
     * Show the form for editing the specified iot_device.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iotDevice = $this->iotDeviceRepository->find($id);

        if (empty($iotDevice)) {
            Flash::error('Iot Device not found');

            return redirect(route('iotDevices.index'));
        }

        return view('iot_devices.edit')->with('iotDevice', $iotDevice);
    }

    /**
     * Update the specified iot_device in storage.
     *
     * @param int $id
     * @param Updateiot_deviceRequest $request
     *
     * @return Response
     */
    public function update($id, Updateiot_deviceRequest $request)
    {
        $iotDevice = $this->iotDeviceRepository->find($id);

        if (empty($iotDevice)) {
            Flash::error('Iot Device not found');

            return redirect(route('iotDevices.index'));
        }

        $iotDevice = $this->iotDeviceRepository->update($request->all(), $id);

        Flash::success('Iot Device updated successfully.');

        return redirect(route('iotDevices.index'));
    }

    /**
     * Remove the specified iot_device from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iotDevice = $this->iotDeviceRepository->find($id);



        if (empty($iotDevice)) {
            Flash::error('Iot Device not found');

            return redirect(route('iotDevices.index'));
        }

        /****************CURL */

        $fiwareService = $iotDevice->fiwareService;
        $fiwarePath = $iotDevice->fiwarePath;
        $ip = $iotDevice->ipServer;
        $iotPort = config('fiware.fiware_iot_port');
        $url = "http://$ip:$iotPort/iot/devices/$iotDevice->device_id";
        $headers = [
            "Content-Type:application/json",
            "fiware-service:$fiwareService" ,
            "fiware-servicepath:$fiwarePath",
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $server_output = curl_exec ($ch);

        if($server_output === false)
        {
            Flash::error('Error Number:'.curl_errno($ch).',Error String:'.curl_error($ch) );
            curl_close ($ch);
            return redirect(route('iotDevices.create'))->withInput();
        }
        curl_close ($ch);
        $respuesta = json_decode($server_output);
        if(isset($respuesta->name)){
            Flash::error('Error:'.$respuesta->name.','.$respuesta->message);
            return redirect(route('iotDevices.create'))->withInput();
        }
        /******************* */

        $this->iotDeviceRepository->delete($id);

        Flash::success('Iot Device deleted successfully.');

        return redirect(route('iotDevices.index'));
    }
}
