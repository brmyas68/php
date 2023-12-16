<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\GalleryRequest;
use App\Repositories\MySQL\GalleryRepository\InterfaceGalleryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Gallery
 *
 * API endpoints for Gallery
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز گالری تصاویر را انجام دهیم.
 */
class GalleryController extends Controller
{
    private InterfaceGalleryRepository $interfaceGalleryRepository;
    public function __construct(InterfaceGalleryRepository $interfaceGalleryRepository){
        $this->interfaceGalleryRepository = $interfaceGalleryRepository;
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
    public function projectGalleries(int $id){
        $projectGalleries=$this->interfaceGalleryRepository->getProjectGalleries($id)->paginate(8);
        return view("Project.gallery",["galleries" => $projectGalleries,"id" => $id]);
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
    public function store(GalleryRequest $request)
    {
        $image=$request->file("image");
        $imagePath=UploadFunc($image,"gallery");
        $data = [
            "image" => $imagePath,
            "project_id" => $request->projectId
        ];
        $this->interfaceGalleryRepository->insertData($data);
        Session::flash('success', "گالری با موفقیت ثبت شد");
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $gallery=$this->interfaceGalleryRepository->findById($id);
        if($gallery){
            unlink("storage/".$gallery->image);
            $this->interfaceGalleryRepository->deleteData($id);
            Session::flash('success', "گالری با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
