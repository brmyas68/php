<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceRequest;
use App\Http\Resources\Service\ServiceResource;
use App\Repositories\MySQL\ServiceRepository\InterfaceServiceRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Service
 *
 * API endpoints for Service
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز خدمات را انجام دهیم.
 */
class ServiceController extends Controller
{
    private InterfaceServiceRepository $interfaceServiceRepository;
    public function __construct(InterfaceServiceRepository $interfaceServiceRepository){
        $this->interfaceServiceRepository = $interfaceServiceRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services=$this->interfaceServiceRepository->getAll()->get();
        return ServiceResource::collection($services);
    }

    /**
     * Display a listing of the resource.
     */
    public function ServicesInfo(Request $request){
        $services=$this->interfaceServiceRepository->getAll()->paginate(5);
        if($request->search)
            $services=$this->interfaceServiceRepository->searchByColumn("name",$request->search)->get();
        return view("Service.index",["services" => $services,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Service.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $image=$request->file("image");
        $path=UploadFunc($image,"service");
        $data = [
            "image" => $path,
            "name" => $request->name,
            "description" => $request->description
        ];
        $this->interfaceServiceRepository->insertData($data);
        Session::flash('success', "خدمت با موفقیت ثبت شد");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $info=$this->interfaceServiceRepository->findById($id);
        if($info)
            return ServiceResource::make($info);
        return response()->json([
           "message" =>  "اطلاعات نادرست است!",
            "status" => false
        ],Response::HTTP_BAD_REQUEST);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $info=$this->interfaceServiceRepository->findById($id);
        if($info)
            return view("Service.edit",["service" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, int $id)
    {
        $serviceInfo=$this->interfaceServiceRepository->findById($id);
        if($serviceInfo){
            $path=$serviceInfo->image;
            $image=$request->file("image");
            if($image){
                unlink("storage/".$serviceInfo->image);
                $path=UploadFunc($image,"service");
            }
            $data = [
                "image" => $path,
                "name" => $request->name,
                "description" => $request->description
            ];
            $this->interfaceServiceRepository->updateItem($id,$data);
            Session::flash('success', "خدمت با موفقیت ویرایش شد");
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
        $serviceInfo=$this->interfaceServiceRepository->findById($id);
        if($serviceInfo){
            unlink("storage/".$serviceInfo->image);
            $this->interfaceServiceRepository->deleteData($id);
            Session::flash('success', "خدمت با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
