<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatesleepRequest;
use App\Http\Requests\UpdatesleepRequest;
use App\Repositories\sleepRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class sleepController extends AppBaseController
{
    /** @var  sleepRepository */
    private $sleepRepository;

    public function __construct(sleepRepository $sleepRepo)
    {
        $this->sleepRepository = $sleepRepo;
    }

    /**
     * Display a listing of the sleep.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $sleeps = $this->sleepRepository->all();

        return view('sleeps.index')
            ->with('sleeps', $sleeps);
    }

    /**
     * Show the form for creating a new sleep.
     *
     * @return Response
     */
    public function create()
    {
        return view('sleeps.create');
    }

    /**
     * Store a newly created sleep in storage.
     *
     * @param CreatesleepRequest $request
     *
     * @return Response
     */
    public function store(CreatesleepRequest $request)
    {
        $input = $request->all();

        $sleep = $this->sleepRepository->create($input);

        Flash::success('Sleep saved successfully.');

        return redirect(route('sleeps.index'));
    }

    /**
     * Display the specified sleep.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sleep = $this->sleepRepository->find($id);

        if (empty($sleep)) {
            Flash::error('Sleep not found');

            return redirect(route('sleeps.index'));
        }

        return view('sleeps.show')->with('sleep', $sleep);
    }

    /**
     * Show the form for editing the specified sleep.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sleep = $this->sleepRepository->find($id);

        if (empty($sleep)) {
            Flash::error('Sleep not found');

            return redirect(route('sleeps.index'));
        }

        return view('sleeps.edit')->with('sleep', $sleep);
    }

    /**
     * Update the specified sleep in storage.
     *
     * @param int $id
     * @param UpdatesleepRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatesleepRequest $request)
    {
        $sleep = $this->sleepRepository->find($id);

        if (empty($sleep)) {
            Flash::error('Sleep not found');

            return redirect(route('sleeps.index'));
        }

        $sleep = $this->sleepRepository->update($request->all(), $id);

        Flash::success('Sleep updated successfully.');

        return redirect(route('sleeps.index'));
    }

    /**
     * Remove the specified sleep from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sleep = $this->sleepRepository->find($id);

        if (empty($sleep)) {
            Flash::error('Sleep not found');

            return redirect(route('sleeps.index'));
        }

        $this->sleepRepository->delete($id);

        Flash::success('Sleep deleted successfully.');

        return redirect(route('sleeps.index'));
    }
}
