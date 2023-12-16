<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\CategoryRequest;
use App\Repositories\MySQL\CategoryRepository\InterfaceCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Category
 *
 * API endpoints for Category
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز دسته بندی را انجام دهیم.
 */
class CategoryController extends Controller
{
    private InterfaceCategoryRepository $interfaceCategoryRepository;
    public function __construct(InterfaceCategoryRepository $interfaceCategoryRepository){
        $this->interfaceCategoryRepository = $interfaceCategoryRepository;
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
    public function CategoriesInfo(Request $request){
        $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
        if($request->search)
            $categories=$this->interfaceCategoryRepository->searchByColumn("name",$request->search)->get();
        return view("Category.index",["categories" => $categories,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
        return view("Category.create",["categories" => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $parentId=0;
        $level=1;
        if($request->parentId){
            $parentInfo=$this->interfaceCategoryRepository->findById($request->parentId);
            $parentId=$parentInfo->id;
            $level=$parentInfo->level+1;
        }
        $data = [
            "name" => $request->name,
            "level" => $level,
            "parent_id" => $parentId
        ];
        $this->interfaceCategoryRepository->insertData($data);
        Session::flash('success', "دسته با موفقیت ثبت شد");
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
        $info=$this->interfaceCategoryRepository->findById($id);
        if($info){
            $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
            return view("Category.edit",["category" => $info,"categories" => $categories]);
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        $parentId=0;
        $level=1;
        if($request->parentId){
            $parentInfo=$this->interfaceCategoryRepository->findById($request->parentId);
            $parentId=$parentInfo->id;
            $level=$parentInfo->level+1;
        }
        $data = [
            "name" => $request->name,
            "level" => $level,
            "parent_id" => $parentId
        ];
        if($this->interfaceCategoryRepository->updateItem($id,$data)){
            Session::flash('success', "دسته با موفقیت ویرایش شد");
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
        if($this->interfaceCategoryRepository->deleteData($id)){
            Session::flash('success', "دسته با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function totalDelete(Request $request)
    {
        if($request->deletedIds && count($request->deletedIds)){
            if($this->interfaceCategoryRepository->deleteTotal($request->deletedIds)){
                Session::flash('success', "دسته ها با موفقیت حذف شدند");
                return redirect()->back();
            }
        }
        Session::flash('fails', "دسته های موردنظرتان را انتخاب کنید");
        return redirect()->back();
    }

}
