<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\TagRequest;
use App\Repositories\MySQL\TagRepository\InterfaceTagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Tag
 *
 * API endpoints for Tag
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز برچسب ها را انجام دهیم.
 */
class TagController extends Controller
{
    private InterfaceTagRepository $interfaceTagRepository;
    public function __construct(InterfaceTagRepository $interfaceTagRepository){
        $this->interfaceTagRepository = $interfaceTagRepository;
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
    public function TagsInfo(Request $request){
        $tags=$this->interfaceTagRepository->getAll()->paginate(5);
        if($request->search)
            $tags=$this->interfaceTagRepository->searchByColumn("name",$request->search)->get();
        return view("Tag.index",["tags" => $tags,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Tag.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TagRequest $request)
    {
        $data = [
            "name" => $request->name
        ];
        $this->interfaceTagRepository->insertData($data);
        Session::flash('success', "برچسب با موفقیت ثبت شد");
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
        $info=$this->interfaceTagRepository->findById($id);
        if($info)
            return view("Tag.edit",["tag" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagRequest $request, int $id)
    {
        $data = [
            "name" => $request->name
        ];
        if($this->interfaceTagRepository->updateItem($id,$data)){
            Session::flash('success', "برچسب با موفقیت ویرایش شد");
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
        if($this->interfaceTagRepository->deleteData($id)){
            Session::flash('success', "برچسب با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
