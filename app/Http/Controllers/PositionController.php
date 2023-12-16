<?php

namespace App\Http\Controllers;

use App\Http\Requests\Position\PositionRequest;
use App\Repositories\MySQL\PositionRepository\InterfacePositionRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Position
 *
 * API endpoints for Position
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز سمت های اجرایی را انجام دهیم.
 */
class PositionController extends Controller
{
    private InterfacePositionRepository $interfacePositionRepository;
    public function __construct(InterfacePositionRepository $interfacePositionRepository){
        $this->interfacePositionRepository = $interfacePositionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function PositionsInfo(Request $request){
        $positions=$this->interfacePositionRepository->getAll()->paginate(5);
        if($request->search)
            $positions=$this->interfacePositionRepository->searchByColumn("name",$request->search)->get();
        return view("Position.index",["positions" => $positions,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Position.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PositionRequest $request)
    {
        $data = [
            "name" => $request->name
        ];
        $this->interfacePositionRepository->insertData($data);
        Session::flash('success', "سمت اجرایی با موفقیت ثبت شد");
        return redirect()->back();
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
        $info=$this->interfacePositionRepository->findById($id);
        if($info)
            return view("Position.edit",["position" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PositionRequest $request, int $id)
    {
        $data = [
            "name" => $request->name
        ];
        if($this->interfacePositionRepository->updateItem($id,$data)){
            Session::flash('success', "سمت اجرایی با موفقیت ویرایش شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if($this->interfacePositionRepository->deleteData($id)){
            Session::flash('success', "سمت اجرایی با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
