<?php

namespace App\Http\Controllers;

use App\Http\Requests\SocialMedia\SocialMediaRequest;
use App\Http\Resources\SocialMedia\SocialMediaResource;
use App\Repositories\MySQL\SocialMediaRepository\InterfaceSocialMediaRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group SocialMedia
 *
 * API endpoints for SocialMedia
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز شبکه های اجتماعی را انجام دهیم.
 */
class SocialMediaController extends Controller
{
    private InterfaceSocialMediaRepository $interfaceSocialMediaRepository;
    public function __construct(InterfaceSocialMediaRepository $interfaceSocialMediaRepository){
        $this->interfaceSocialMediaRepository = $interfaceSocialMediaRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialMedias=$this->interfaceSocialMediaRepository->getAll()->get();
        return SocialMediaResource::collection($socialMedias);
    }

    /**
     * Display a listing of the resource.
     */
    public function SocialMediasInfo(Request $request){
        $socialMedias=$this->interfaceSocialMediaRepository->getAll()->paginate(5);
        if($request->search)
           $socialMedias=$this->interfaceSocialMediaRepository->search($request->search)->get();
        return view("SocialMedia.index",["socialMedias" => $socialMedias,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("SocialMedia.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SocialMediaRequest $request)
    {
        $icon=$request->file("icon");
        $iconPath=UploadFunc($icon,"socialmedia");
        $data = [
            "name" => $request->name,
            "icon" => $iconPath,
            "username" => $request->username,
            "link" => $request->link
        ];
        $this->interfaceSocialMediaRepository->insertData($data);
        Session::flash('success', "شبکه اجتماعی با موفقیت ثبت شد");
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
        $info=$this->interfaceSocialMediaRepository->findById($id);
        if($info)
            return view("SocialMedia.edit",["socialMedia" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SocialMediaRequest $request, int $id)
    {
        $socialmediaInfo=$this->interfaceSocialMediaRepository->findById($id);
        if($socialmediaInfo){
            $icon=$request->file("icon");
            $iconPath=$socialmediaInfo->icon;
            if($icon){
                unlink("storage/".$socialmediaInfo->icon);
                $iconPath=UploadFunc($icon,"socialmedia");
            }
            $data = [
                "name" => $request->name,
                "icon" => $iconPath,
                "username" => $request->username,
                "link" => $request->link
            ];
            $this->interfaceSocialMediaRepository->updateItem($id,$data);
            Session::flash('success', "شبکه اجتماعی با موفقیت ویرایش شد");
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
        $socialmediaInfo=$this->interfaceSocialMediaRepository->findById($id);
        if($socialmediaInfo){
            if($socialmediaInfo->icon)
                unlink("storage/".$socialmediaInfo->icon);
            $this->interfaceSocialMediaRepository->deleteData($id);
            Session::flash('success', "شبکه اجتماعی با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
