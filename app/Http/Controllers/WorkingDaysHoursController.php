<?php

namespace App\Http\Controllers;

use App\Enums\DaysHoursStatus;
use App\Http\Requests\WorkingDaysHours\WorkingDaysHoursRequest;
use App\Http\Resources\WorkingDaysHours\WorkingDaysHoursResource;
use App\Repositories\MySQL\WorkingDaysHoursRepository\InterfaceWorkingDaysHoursRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group WorkingDaysHours
 *
 * API endpoints for WorkingDaysHours
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز روز و ساعت کاری را انجام دهیم.
 */
class WorkingDaysHoursController extends Controller
{
    private InterfaceWorkingDaysHoursRepository $interfaceWorkingDaysHoursRepository;
    public function __construct(InterfaceWorkingDaysHoursRepository $interfaceWorkingDaysHoursRepository){
        $this->interfaceWorkingDaysHoursRepository = $interfaceWorkingDaysHoursRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dayshours=$this->interfaceWorkingDaysHoursRepository->query()->get();
        return WorkingDaysHoursResource::collection($dayshours);
    }

    public function DaysHoursInfo(){
        $dayshours=$this->interfaceWorkingDaysHoursRepository->query()->paginate(5);
        return view("WorkingDaysHours.index",["dayshours" => $dayshours]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $info=$this->interfaceWorkingDaysHoursRepository->findById($id);
        if($info)
            return view("WorkingDaysHours.edit",["dayhour" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WorkingDaysHoursRequest $request, int $id)
    {
        $data = [
            "status" => $request->status,
            "start_work" => $request->status == DaysHoursStatus::open ? $request->startWork : null,
            "end_work" => $request->status == DaysHoursStatus::open ? $request->endWork : null
        ];
        if($this->interfaceWorkingDaysHoursRepository->updateItem($id,$data)){
            Session::flash('success', "روز و ساعت کاری با موفقیت ویرایش شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
