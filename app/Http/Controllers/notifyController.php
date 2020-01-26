<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatenotifyRequest;
use App\Http\Requests\UpdatenotifyRequest;
use App\Repositories\notifyRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\iotService;
use App\Models\notify;
use Illuminate\Http\Request;
use Flash;
use Response;
use Log;


class notifyController extends AppBaseController
{

    /** @var  notifyRepository */
    private $notifyRepository;

    public function __construct(notifyRepository $notifyRepo)
    {
        $this->notifyRepository = $notifyRepo;
    }

    /**
     * Display a listing of the notify.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $notifies = $this->notifyRepository->all();

        return view('notifies.index')
            ->with('notifies', $notifies);
    }

    /**
     * Show the form for creating a new notify.
     *
     * @return Response
     */
    public function create()
    {
        $conjunto = iotService::pluck('entity_type','entity_type');
        $spa = iotService::pluck('fiwarePath','fiwarePath');
        return view('notifies.create')->with('conjunto', $conjunto)->with('spa', $spa);
    }

    /**
     * Store a newly created notify in storage.
     *
     * @param CreatenotifyRequest $request
     *
     * @return Response
     */
    public function store(CreatenotifyRequest $request)
    {

        $input = $request->all();
        $ip = config('fiware.fiware_servidor_ip');
        $service = config('fiware.fiware_service');
        $path = $input['fiwarePath'];
        $mensaje = $input['description'];
        $type = $input['type'];
        $portOrion = config('fiware.fiware_orion_port');
        $ipCygnus = config('fiware.fiware_cygnus_ip');
        $portCygnus = config('fiware.fiware_cygnus_port');
        $url = "http://$ip:$portOrion/v2/subscriptions";
        $urlCygnus = "http://$ipCygnus:$portCygnus/notify";

        try{
            $data = '{"description": "'.$mensaje.'", "subject": { "entities": [{"idPattern": ".*", "type": "'.$type.'"}]},"notification": {"http": {"url": "'.$urlCygnus.'"},"attrsFormat": "legacy"},"throttling": 5}';
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
        }
            catch(\Exception $e){
                Log::critical('No se pudo crear la subcripcion: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
                return response('No se pudo crear la subcripcion: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage(), 500);
            }

        $notify = new notify;
        $notify->ipServer = $ip;
        $notify->fiwareService = $service;
        $notify->fiwarePath = $path;
        $notify->type = $type;
        $notify->description = $mensaje;
        $notify->save();


        Flash::success('Subscripción dentro de orion creada.');

        return redirect(route('notifies.index'));
    }

    /**
     * Display the specified notify.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $notify = $this->notifyRepository->find($id);

        if (empty($notify)) {
            Flash::error('Notify not found');

            return redirect(route('notifies.index'));
        }

        return view('notifies.show')->with('notify', $notify);
    }

    /**
     * Show the form for editing the specified notify.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $notify = $this->notifyRepository->find($id);

        if (empty($notify)) {
            Flash::error('Notify not found');

            return redirect(route('notifies.index'));
        }

        return view('notifies.edit')->with('notify', $notify);
    }

    /**
     * Update the specified notify in storage.
     *
     * @param int $id
     * @param UpdatenotifyRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatenotifyRequest $request)
    {
        $notify = $this->notifyRepository->find($id);

        if (empty($notify)) {
            Flash::error('Notify not found');

            return redirect(route('notifies.index'));
        }

        $notify = $this->notifyRepository->update($request->all(), $id);

        Flash::success('Notify updated successfully.');

        return redirect(route('notifies.index'));
    }

    /**
     * Remove the specified notify from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $notify = $this->notifyRepository->find($id);

        if (empty($notify)) {
            Flash::error('Notify not found');

            return redirect(route('notifies.index'));
        }


        $this->notifyRepository->delete($id);

        Flash::success('Notify deleted successfully.');

        return redirect(route('notifies.index'));
    }
}
