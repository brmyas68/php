<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ClientRequest;
use App\Http\Resources\Client\ClientResource;
use App\Repositories\MySQL\ClientRepository\InterfaceClientRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Client
 *
 * API endpoints for Client
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز مشتریان/کارفرمایان را انجام دهیم.
 */
class ClientController extends Controller
{
    private InterfaceClientRepository $interfaceClientRepository;
    public function __construct(InterfaceClientRepository $interfaceClientRepository){
        $this->interfaceClientRepository = $interfaceClientRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=$this->interfaceClientRepository->getAll()->get();
        return ClientResource::collection($clients);
    }

    /**
     * Display a listing of the resource.
     */
    public function ClientsInfo(Request $request){
        $clients=$this->interfaceClientRepository->getAll()->paginate(5);
        if ($request->search)
            $clients=$this->interfaceClientRepository->searchByColumn("name",$request->search)->get();
        return view("Client.index",["clients" => $clients,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Client.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $path=null;
        $logo=$request->file("logo");
        if($logo)
            $path=UploadFunc($logo,"client");

        $data = [
            "logo" => $path,
            "name" => $request->name
        ];
        $this->interfaceClientRepository->insertData($data);
        Session::flash('success', "مشتری با موفقیت ثبت شد");
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
        $info=$this->interfaceClientRepository->findById($id);
        if($info)
            return view("Client.edit",["client" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, int $id)
    {
        $clientInfo=$this->interfaceClientRepository->findById($id);
        if($clientInfo){
            $path=$clientInfo->logo;
            $logo=$request->file("logo");
            if($logo){
                if($clientInfo->logo)
                    unlink("storage/".$clientInfo->logo);
                $path=UploadFunc($logo,"client");
            }

            $data = [
                "logo" => $path,
                "name" => $request->name
            ];
            $this->interfaceClientRepository->updateItem($id,$data);
            Session::flash('success', "مشتری با موفقیت ویرایش شد");
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
        $clientInfo=$this->interfaceClientRepository->findById($id);
        if($clientInfo){
            if($clientInfo->logo)
                unlink("storage/".$clientInfo->logo);
            $this->interfaceClientRepository->deleteData($id);
            Session::flash('success', "مشتری با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
