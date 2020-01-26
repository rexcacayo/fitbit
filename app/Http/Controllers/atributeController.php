<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateatributeRequest;
use App\Http\Requests\UpdateatributeRequest;
use App\Repositories\atributeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class atributeController extends AppBaseController
{
    /** @var  atributeRepository */
    private $atributeRepository;

    public function __construct(atributeRepository $atributeRepo)
    {
        $this->atributeRepository = $atributeRepo;
    }

    /**
     * Display a listing of the atribute.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $atributes = $this->atributeRepository->all();

        return view('atributes.index')
            ->with('atributes', $atributes);
    }

    /**
     * Show the form for creating a new atribute.
     *
     * @return Response
     */
    public function create()
    {
        return view('atributes.create');
    }

    /**
     * Store a newly created atribute in storage.
     *
     * @param CreateatributeRequest $request
     *
     * @return Response
     */
    public function store(CreateatributeRequest $request)
    {
        $input = $request->all();

        $atribute = $this->atributeRepository->create($input);

        Flash::success('Atribute saved successfully.');

        return redirect(route('atributes.index'));
    }

    /**
     * Display the specified atribute.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $atribute = $this->atributeRepository->find($id);

        if (empty($atribute)) {
            Flash::error('Atribute not found');

            return redirect(route('atributes.index'));
        }

        return view('atributes.show')->with('atribute', $atribute);
    }

    /**
     * Show the form for editing the specified atribute.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $atribute = $this->atributeRepository->find($id);

        if (empty($atribute)) {
            Flash::error('Atribute not found');

            return redirect(route('atributes.index'));
        }

        return view('atributes.edit')->with('atribute', $atribute);
    }

    /**
     * Update the specified atribute in storage.
     *
     * @param int $id
     * @param UpdateatributeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateatributeRequest $request)
    {
        $atribute = $this->atributeRepository->find($id);

        if (empty($atribute)) {
            Flash::error('Atribute not found');

            return redirect(route('atributes.index'));
        }

        $atribute = $this->atributeRepository->update($request->all(), $id);

        Flash::success('Atribute updated successfully.');

        return redirect(route('atributes.index'));
    }

    /**
     * Remove the specified atribute from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $atribute = $this->atributeRepository->find($id);

        if (empty($atribute)) {
            Flash::error('Atribute not found');

            return redirect(route('atributes.index'));
        }

        $this->atributeRepository->delete($id);

        Flash::success('Atribute deleted successfully.');

        return redirect(route('atributes.index'));
    }
}
