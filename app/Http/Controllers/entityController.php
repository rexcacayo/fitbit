<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateentityRequest;
use App\Http\Requests\UpdateentityRequest;
use App\Repositories\entityRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\atribute;
use Log;

class entityController extends AppBaseController
{
    /** @var  entityRepository */
    private $entityRepository;

    public function __construct(entityRepository $entityRepo)
    {
        $this->entityRepository = $entityRepo;
    }

    /**
     * Display a listing of the entity.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $entities = $this->entityRepository->all();

        return view('entities.index')
            ->with('entities', $entities);
    }

    /**
     * Show the form for creating a new entity.
     *
     * @return Response
     */
    public function create()
    {
        return view('entities.create');
    }

    /**
     * Store a newly created entity in storage.
     *
     * @param CreateentityRequest $request
     *
     * @return Response
     */
    public function store(CreateentityRequest $request)
    {
        $input = $request->all();

        if ( empty($input['attrName']))
        {
            Flash::error('Error: You must add the attributes of the entity');

                return redirect(route('entities.create'))->withInput();    
        }
        
        
        
        /***validar ip server  */
        try{
            /*proceso para crear entidada en mongo*/
            $fiwareService = $input['fiwareService'];
            $fiwarePath = $input['fiwarePath'];
            $ip = $input['ipServer'];
            $url = "http://$ip:1026/v2/entities";
            $entidadId = $input['entityID'];
            $entidadaTipo = $input['typeEntity'];
            $atributoNombre = $input['attrName'];
            $atributoTipo = $input['attrType'];
            $tamanoAtributo = count($atributoNombre);
            /*creacion de identidad*/

            $data = [

                'id' => $entidadId,

                'type'=>$entidadaTipo,

            ];
            for ($i=0;$i < $tamanoAtributo; $i++){

                $data[$atributoNombre[$i]]['type'] = $atributoTipo[$i];

                $data[$atributoNombre[$i]]['value'] = "0";
            };

            $data_json = json_encode($data);
            //echo $data_json;
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
                return redirect(route('entities.create'))->withInput();
            }
            curl_close ($ch);
            
            $respuesta = json_decode($server_output);
            
            if($respuesta !== null){
                
                Flash::error('Error:'.$respuesta->error.','.$respuesta->description);

                return redirect(route('entities.create'))->withInput();

            }
        }

        catch(\Exception $e){
            Log::critical('No se pudo crear la entidad: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage());
            return response('No se pudo crear la entidad: ' . $e->getCode() . ', ' . $e->getLine() . ', ' . $e->getMessage(), 500);
        }

        $entity = $this->entityRepository->create($input);
        $entity = $this->entityRepository->find($entity->id);
        $attrName = $input['attrName'];
        $attrType = $input['attrType'];
        $attr = new atribute;
        $i = 0;
        foreach ($attrName as $name) {
            $attr->name = $name;
            $attr->type = $attrType[$i];

            if ($attrType[$i] === "String"){
                $attr->value = "0";

            }elseif ($attrType[$i] === "Float"){
                $attr->value = 0.0;

            }else{
                $attr->value = 0;       
            }
            
            $entity->atributo()->save($attr);
            $i++;
            $attr = new atribute;
            
        }

        Flash::success('Entity saved successfully.');

        return redirect(route('entities.index'));
    }

    /**
     * Display the specified entity.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $entity = $this->entityRepository->find($id);

        if (empty($entity)) {
            Flash::error('Entity not found');

            return redirect(route('entities.index'));
        }

        return view('entities.show')->with('entity', $entity);
    }

    /**
     * Show the form for editing the specified entity.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $entity = $this->entityRepository->find($id);

        if (empty($entity)) {
            Flash::error('Entity not found');

            return redirect(route('entities.index'));
        }

        return view('entities.edit')->with('entity', $entity);
    }

    /**
     * Update the specified entity in storage.
     *
     * @param int $id
     * @param UpdateentityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateentityRequest $request)
    {
        $entity = $this->entityRepository->find($id);

        if (empty($entity)) {
            Flash::error('Entity not found');

            return redirect(route('entities.index'));
        }

        $entity = $this->entityRepository->update($request->all(), $id);

        Flash::success('Entity updated successfully.');

        return redirect(route('entities.index'));
    }

    /**
     * Remove the specified entity from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $entity = $this->entityRepository->find($id);

        if (empty($entity)) {
            Flash::error('Entity not found');

            return redirect(route('entities.index'));
        }

        /**proceso para eliminar entidada en mongo */

            $urlD = "http://$entity->ipServer:1026/v2/entities/$entity->entityID?type=$entity->typeEntity";
            $fiwareService = $entity->fiwareService;
            $fiwarePath = $entity->fiwarePath;
            
            $headers = [
                "Accept:application/json", 
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

        $this->entityRepository->delete($id);
        $entity->atributo()->delete();


        Flash::success('Entity deleted successfully.');

        return redirect(route('entities.index'));
    }
}
