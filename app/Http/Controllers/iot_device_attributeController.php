<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createiot_device_attributeRequest;
use App\Http\Requests\Updateiot_device_attributeRequest;
use App\Repositories\iot_device_attributeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class iot_device_attributeController extends AppBaseController
{
    /** @var  iot_device_attributeRepository */
    private $iotDeviceAttributeRepository;

    public function __construct(iot_device_attributeRepository $iotDeviceAttributeRepo)
    {
        $this->iotDeviceAttributeRepository = $iotDeviceAttributeRepo;
    }

    /**
     * Display a listing of the iot_device_attribute.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $iotDeviceAttributes = $this->iotDeviceAttributeRepository->all();

        return view('iot_device_attributes.index')
            ->with('iotDeviceAttributes', $iotDeviceAttributes);
    }

    /**
     * Show the form for creating a new iot_device_attribute.
     *
     * @return Response
     */
    public function create()
    {
        return view('iot_device_attributes.create');
    }

    /**
     * Store a newly created iot_device_attribute in storage.
     *
     * @param Createiot_device_attributeRequest $request
     *
     * @return Response
     */
    public function store(Createiot_device_attributeRequest $request)
    {
        $input = $request->all();

        $iotDeviceAttribute = $this->iotDeviceAttributeRepository->create($input);

        Flash::success('Iot Device Attribute saved successfully.');

        return redirect(route('iotDeviceAttributes.index'));
    }

    /**
     * Display the specified iot_device_attribute.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $iotDeviceAttribute = $this->iotDeviceAttributeRepository->find($id);

        if (empty($iotDeviceAttribute)) {
            Flash::error('Iot Device Attribute not found');

            return redirect(route('iotDeviceAttributes.index'));
        }

        return view('iot_device_attributes.show')->with('iotDeviceAttribute', $iotDeviceAttribute);
    }

    /**
     * Show the form for editing the specified iot_device_attribute.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $iotDeviceAttribute = $this->iotDeviceAttributeRepository->find($id);

        if (empty($iotDeviceAttribute)) {
            Flash::error('Iot Device Attribute not found');

            return redirect(route('iotDeviceAttributes.index'));
        }

        return view('iot_device_attributes.edit')->with('iotDeviceAttribute', $iotDeviceAttribute);
    }

    /**
     * Update the specified iot_device_attribute in storage.
     *
     * @param int $id
     * @param Updateiot_device_attributeRequest $request
     *
     * @return Response
     */
    public function update($id, Updateiot_device_attributeRequest $request)
    {
        $iotDeviceAttribute = $this->iotDeviceAttributeRepository->find($id);

        if (empty($iotDeviceAttribute)) {
            Flash::error('Iot Device Attribute not found');

            return redirect(route('iotDeviceAttributes.index'));
        }

        $iotDeviceAttribute = $this->iotDeviceAttributeRepository->update($request->all(), $id);

        Flash::success('Iot Device Attribute updated successfully.');

        return redirect(route('iotDeviceAttributes.index'));
    }

    /**
     * Remove the specified iot_device_attribute from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $iotDeviceAttribute = $this->iotDeviceAttributeRepository->find($id);

        if (empty($iotDeviceAttribute)) {
            Flash::error('Iot Device Attribute not found');

            return redirect(route('iotDeviceAttributes.index'));
        }

        $this->iotDeviceAttributeRepository->delete($id);

        Flash::success('Iot Device Attribute deleted successfully.');

        return redirect(route('iotDeviceAttributes.index'));
    }
}
