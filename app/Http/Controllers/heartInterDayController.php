<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateheartInterDayRequest;
use App\Http\Requests\UpdateheartInterDayRequest;
use App\Repositories\heartInterDayRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\fitbit;
use Carbon\Carbon;
use App\Models\heartInterDay;

class heartInterDayController extends AppBaseController
{
    /** @var  heartInterDayRepository */
    private $heartInterDayRepository;

    public function __construct(heartInterDayRepository $heartInterDayRepo)
    {
        $this->heartInterDayRepository = $heartInterDayRepo;
    }

    /**
     * Display a listing of the heartInterDay.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        //$heartInterDays = $this->heartInterDayRepository->all();
        $fitbitUser = fitbit::pluck('name','user_id');
        $startDate = new Carbon('yesterday');
        $endDate = Carbon::now();
        return view('heart_inter_days.index');
    }

    /**
     * Show the form for creating a new heartInterDay.
     *
     * @return Response
     */
    public function create()
    {
        $fitbitUser = fitbit::pluck('name','user_id');
        $startDate = new Carbon('yesterday');
        $endDate = Carbon::now();
        return view('heart_inter_days.create')->with('fitbitUser', $fitbitUser)->with('endDate', $endDate)->with('startDate', $startDate);
    }

    /**
     * Store a newly created heartInterDay in storage.
     *
     * @param CreateheartInterDayRequest $request
     *
     * @return Response
     */
    public function store(CreateheartInterDayRequest $request)
    {
        $input = $request->all();

        $dateStart = $input['dateStart']."T00:00:00.000";
        $dateEnd = $input['dateStart']."T23:59:59.000";
        $rango = "24 horas de consulta de ritmo cardíaco ";
        $datos = heartInterDay::where('attrValue','=',$input['user_id'])->whereBetween('recvTime', array($dateStart, $dateEnd ))->get('recvTime')->toArray();

        foreach($datos as $dato){
            $datosV['time'][] = heartInterDay::where('recvTime', '=', $dato['recvTime'] )->where('attrName', '=', 'time')->get('attrValue')->toArray();
            $datosV['value'][] = heartInterDay::where('recvTime', '=', $dato['recvTime'] )->where('attrName', '=', 'value')->get('attrValue')->toArray();

        }

        $rango = $input['dateStart'];
        $total = count($datosV['time']);

        for($i=0; $i<$total; $i++){
            $dataV[$i]['x'] = $datosV['time'][$i][0]['attrValue'];
            $dataV[$i]['y'] = $datosV['value'][$i][0]['attrValue'];
        }
        return view('heart_inter_days.chart')->with('datos', $dataV)->with('rango', $rango);

    }

    /**
     * Display the specified heartInterDay.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $heartInterDay = $this->heartInterDayRepository->find($id);

        if (empty($heartInterDay)) {
            Flash::error('Heart Inter Day not found');

            return redirect(route('heartInterDays.index'));
        }

        return view('heart_inter_days.show')->with('heartInterDay', $heartInterDay);
    }

    /**
     * Show the form for editing the specified heartInterDay.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $heartInterDay = $this->heartInterDayRepository->find($id);

        if (empty($heartInterDay)) {
            Flash::error('Heart Inter Day not found');

            return redirect(route('heartInterDays.index'));
        }

        return view('heart_inter_days.edit')->with('heartInterDay', $heartInterDay);
    }

    /**
     * Update the specified heartInterDay in storage.
     *
     * @param int $id
     * @param UpdateheartInterDayRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateheartInterDayRequest $request)
    {
        $heartInterDay = $this->heartInterDayRepository->find($id);

        if (empty($heartInterDay)) {
            Flash::error('Heart Inter Day not found');

            return redirect(route('heartInterDays.index'));
        }

        $heartInterDay = $this->heartInterDayRepository->update($request->all(), $id);

        Flash::success('Heart Inter Day updated successfully.');

        return redirect(route('heartInterDays.index'));
    }

    /**
     * Remove the specified heartInterDay from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $heartInterDay = $this->heartInterDayRepository->find($id);

        if (empty($heartInterDay)) {
            Flash::error('Heart Inter Day not found');

            return redirect(route('heartInterDays.index'));
        }

        $this->heartInterDayRepository->delete($id);

        Flash::success('Heart Inter Day deleted successfully.');

        return redirect(route('heartInterDays.index'));
    }
}
