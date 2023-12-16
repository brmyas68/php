<?php

namespace App\Http\Controllers;

use App\Http\Requests\Attribute\AttributeRequest;
use App\Http\Resources\Attribute\AttributeResource;
use App\Repositories\MySQL\AttributeRepository\InterfaceAttributeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Attribute
 *
 * API endpoints for Attribute
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز ویژگی های شرکت را انجام دهیم.
 */
class AttributeController extends Controller
{
    private InterfaceAttributeRepository $interfaceAttributeRepository;
    public function __construct(InterfaceAttributeRepository $interfaceAttributeRepository){
        $this->interfaceAttributeRepository = $interfaceAttributeRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attributes=$this->interfaceAttributeRepository->getAll()->get();
        return AttributeResource::collection($attributes);
    }

    /**
     * Display a listing of the resource.
     */
    public function AttributesInfo(Request $request){
        $attributes=$this->interfaceAttributeRepository->getAll()->paginate(5);
        if($request->search)
            $attributes=$this->interfaceAttributeRepository->searchByColumn("name",$request->search)->get();
        return view("Attribute.index",["attributes" => $attributes,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Attribute.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $data = [
            "name" => $request->name,
            "icon" => $request->icon
        ];
        $this->interfaceAttributeRepository->insertData($data);
        Session::flash('success', "ویژگی جدید با موفقیت ثبت شد");
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
        $info=$this->interfaceAttributeRepository->findById($id);
        if($info)
            return view("Attribute.edit",["attribute" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, int $id)
    {
        $data = [
            "name" => $request->name,
            "icon" => $request->icon
        ];
        if($this->interfaceAttributeRepository->updateItem($id,$data)){
            Session::flash('success', "ویژگی موردنظر با موفقیت ویرایش شد");
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
        if($this->interfaceAttributeRepository->deleteData($id)){
            Session::flash('success', "ویژگی موردنظر با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
