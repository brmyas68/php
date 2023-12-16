<?php

namespace App\Http\Controllers;

use App\Enums\BoolStatus;
use App\Enums\SliderType;
use App\Http\Requests\Slider\AddProjectRequest;
use App\Http\Requests\Slider\SliderRequest;
use App\Http\Resources\Slider\SliderResource;
use App\Repositories\MySQL\ProjectRepository\InterfaceProjectRepository;
use App\Repositories\MySQL\SliderRepository\InterfaceSliderRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Slider
 *
 * API endpoints for Slider
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز اسلایدرها را انجام دهیم.
 */
class SliderController extends Controller
{
    private InterfaceSliderRepository $interfaceSliderRepository;
    private InterfaceProjectRepository$interfaceProjectRepository;
    public function __construct(InterfaceSliderRepository $interfaceSliderRepository,InterfaceProjectRepository $interfaceProjectRepository){
        $this->interfaceSliderRepository = $interfaceSliderRepository;
        $this->interfaceProjectRepository = $interfaceProjectRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides=$this->interfaceSliderRepository->getActiveSliders()->get();
        return SliderResource::collection($slides);
    }

    /**
     * Display a listing of the resource.
     */
    public function SlidesInfo(){
        $slides=$this->interfaceSliderRepository->getAll()->orderBy("is_active","desc")->paginate(5);
        return view("Slider.index",["slides" => $slides]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Slider.create");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addProjectPage()
    {
        $projects=$this->interfaceProjectRepository->query()->where("show_in_slider",BoolStatus::no)->get();
        return view("Slider.addProject",["projects" => $projects]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderRequest $request)
    {
        $file=$request->file("file");
        $filePath=UploadFunc($file,"slider");
        $type=explode("/",$file->getMimeType())[0];
        $mobileFile=$request->file("mobileFile");
        $mobileFilePath=UploadFunc($mobileFile,"slider");
        $mobileFileType=explode("/",$mobileFile->getMimeType())[0];
        $data=[
            "file" => $filePath,
            "type" => $type,
            "mobile_file" => $mobileFilePath,
            "mobile_file_type" => $mobileFileType,
            "link" => $request->link,
            "title" => $request->title,
            "order" => $request->order
        ];
        $this->interfaceSliderRepository->insertData($data);
        Session::flash('success', "اسلاید با موفقیت ثبت شد");
        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function addProject(AddProjectRequest $request)
    {
        $projectInfo=$this->interfaceProjectRepository->findById($request->projectId);
        if($projectInfo->mobile_image){
            $data=[
                "file" => $projectInfo->image,
                "type" => SliderType::image,
                "mobile_file" => $projectInfo->mobile_image,
                "mobile_file_type" => SliderType::image,
                "title" => $projectInfo->subject,
                "order" => $request->order,
                "project_id" => $request->projectId
            ];
            $this->interfaceSliderRepository->insertData($data);
            $this->interfaceProjectRepository->updateItem($request->projectId,[
                "show_in_slider" => BoolStatus::yes
            ]);
            Session::flash('success', "پروژه با موفقیت به اسلایدر اضافه شد");
            return redirect()->back();
        }
        Session::flash('fails', "برای افزودن پروژه موردنظر به اسلایدر، ابتدا عکسی برای حالت موبایل آن ثبت کنید");
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
        $info=$this->interfaceSliderRepository->findById($id);
        if($info && $info->project_id == null)
            return view("Slider.edit",["slide" => $info]);
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderRequest $request, int $id)
    {
        $slide=$this->interfaceSliderRepository->findById($id);
        if($slide && !$slide->project_id){
            $file=$request->file("file");
            $filePath=$slide->file;
            $type=$slide->type;
            if($file){
                unlink("storage/".$slide->file);
                $filePath=UploadFunc($file,"slider");
                $type=explode("/",$file->getMimeType())[0];
            }
            $mobileFile=$request->file("mobileFile");
            $mobileFilePath=$slide->mobile_file;
            $mobileFileType=$slide->mobile_file_type;
            if($mobileFile){
                if($slide->mobile_file)
                    unlink("storage/".$slide->mobile_file);
                $mobileFilePath=UploadFunc($mobileFile,"slider");
                $mobileFileType=explode("/",$mobileFile->getMimeType())[0];
            }
            $data=[
                "file" => $filePath,
                "type" => $type,
                "mobile_file" => $mobileFilePath,
                "mobile_file_type" => $mobileFileType,
                "link" => $request->link,
                "title" => $request->title,
                "order" => $request->order,
                "is_active" => $request->isActive
            ];

            $this->interfaceSliderRepository->updateItem($id,$data);
            Session::flash('success', "اسلاید با موفقیت ویرایش شد");
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
        $slide=$this->interfaceSliderRepository->findById($id);
        if($slide){
            if($slide->project_id == null){
                unlink("storage/".$slide->file);
                if($slide->mobile_file)
                    unlink("storage/".$slide->mobile_file);
            }
            else
                $this->interfaceProjectRepository->updateItem($slide->project_id,[
                    "show_in_slider" => BoolStatus::no
                ]);
            $this->interfaceSliderRepository->deleteData($id);
            Session::flash('success', "اسلاید با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
