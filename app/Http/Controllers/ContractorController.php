<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contractor\ContractorRequest;
use App\Repositories\MySQL\ContractorRepository\InterfaceContractorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Contractor
 *
 * API endpoints for Contractor
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز پیمانکاران را انجام دهیم.
 */
class ContractorController extends Controller
{
    private InterfaceContractorRepository $interfaceContractorRepository;
    public function __construct(InterfaceContractorRepository $interfaceContractorRepository){
        $this->interfaceContractorRepository = $interfaceContractorRepository;
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
    public function ContractorsInfo(Request $request){
        $contractors=$this->interfaceContractorRepository->getAll()->paginate(5);
        if ($request->search)
            $contractors=$this->interfaceContractorRepository->searchByColumn("name",$request->search)->get();
        return view("Contractor.index",["contractors" => $contractors,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Contractor.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContractorRequest $request)
    {
        $path=null;
        $logo=$request->file("logo");
        if($logo)
            $path=UploadFunc($logo,"contractor");

        $data = [
            "logo" => $path,
            "name" => $request->name
        ];
        $this->interfaceContractorRepository->insertData($data);
        Session::flash('success', "پیمانکار با موفقیت ثبت شد");
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
        $info=$this->interfaceContractorRepository->findById($id);
        if($info)
            return view("Contractor.edit",["contractor" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContractorRequest $request, int $id)
    {
        $contractorInfo=$this->interfaceContractorRepository->findById($id);
        if($contractorInfo){
            $path=$contractorInfo->logo;
            $logo=$request->file("logo");
            if($logo){
                if($contractorInfo->logo)
                    unlink("storage/".$contractorInfo->logo);
                $path=UploadFunc($logo,"contractor");
            }

            $data = [
                "logo" => $path,
                "name" => $request->name
            ];
            $this->interfaceContractorRepository->updateItem($id,$data);
            Session::flash('success', "پیمانکار با موفقیت ویرایش شد");
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
        $contractorInfo=$this->interfaceContractorRepository->findById($id);
        if($contractorInfo){
            if($contractorInfo->logo)
                unlink("storage/".$contractorInfo->logo);
            $this->interfaceContractorRepository->deleteData($id);
            Session::flash('success', "پیمانکار با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
