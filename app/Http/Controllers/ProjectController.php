<?php

namespace App\Http\Controllers;

use App\Enums\BoolStatus;
use App\Enums\ProjectType;
use App\Http\Requests\Project\ProjectRequest;
use App\Http\Requests\Search\ProjectByTypeRequest;
use App\Http\Requests\Search\ProjectByTypeServiceRequest;
use App\Http\Resources\Project\ProjectDetailResource;
use App\Http\Resources\Project\ProjectResource;
use App\Repositories\MySQL\CityRepository\InterfaceCityRepository;
use App\Repositories\MySQL\ClientRepository\InterfaceClientRepository;
use App\Repositories\MySQL\ContractorRepository\InterfaceContractorRepository;
use App\Repositories\MySQL\GalleryRepository\InterfaceGalleryRepository;
use App\Repositories\MySQL\ProjectRepository\InterfaceProjectRepository;
use App\Repositories\MySQL\ProvinceRepository\InterfaceProvinceRepository;
use App\Repositories\MySQL\ServiceRepository\InterfaceServiceRepository;
use App\Repositories\MySQL\SliderRepository\InterfaceSliderRepository;
use App\Repositories\MySQL\TagRepository\InterfaceTagRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Project
 *
 * API endpoints for Project
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز پروژه ها را انجام دهیم.
 */
class ProjectController extends Controller
{
    private InterfaceProjectRepository $interfaceProjectRepository;
    private InterfaceClientRepository $interfaceClientRepository;
    private InterfaceServiceRepository $interfaceServiceRepository;
    private InterfaceGalleryRepository $interfaceGalleryRepository;
    private InterfaceSliderRepository $interfaceSliderRepository;
    private InterfaceTagRepository $interfaceTagRepository;
    private InterfaceProvinceRepository $interfaceProvinceRepository;
    private InterfaceCityRepository $interfaceCityRepository;
    private InterfaceContractorRepository $interfaceContractorRepository;

    public function __construct(InterfaceProjectRepository $interfaceProjectRepository,InterfaceClientRepository $interfaceClientRepository,
    InterfaceServiceRepository $interfaceServiceRepository,InterfaceGalleryRepository $interfaceGalleryRepository,InterfaceTagRepository
                                $interfaceTagRepository,InterfaceSliderRepository $interfaceSliderRepository,InterfaceProvinceRepository $interfaceProvinceRepository,
    InterfaceCityRepository $interfaceCityRepository,InterfaceContractorRepository $interfaceContractorRepository){
        $this->interfaceProjectRepository = $interfaceProjectRepository;
        $this->interfaceClientRepository = $interfaceClientRepository;
        $this->interfaceServiceRepository = $interfaceServiceRepository;
        $this->interfaceGalleryRepository = $interfaceGalleryRepository;
        $this->interfaceTagRepository = $interfaceTagRepository;
        $this->interfaceSliderRepository = $interfaceSliderRepository;
        $this->interfaceProvinceRepository = $interfaceProvinceRepository;
        $this->interfaceCityRepository = $interfaceCityRepository;
        $this->interfaceContractorRepository = $interfaceContractorRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $count=@$request->count ?? 4;
        $projects=$this->interfaceProjectRepository->getAll()->paginate($count);
        return ProjectResource::collection($projects);
    }

    /**
     * Display a listing of the resource.
     */
    public function projectsByService(int $serviceId,Request $request)
    {
        $count=@$request->count ?? 4;
        $projects=$this->interfaceProjectRepository->projectsByService($serviceId)->paginate($count);
        return ProjectResource::collection($projects);
    }

    /**
     * Display a listing of the resource.
     */
    public function doingProjectsByService(int $serviceId,Request $request)
    {
        $count=@$request->count ?? 4;
        $projects=$this->interfaceProjectRepository->projectsByService($serviceId)->where("type",ProjectType::doing)->paginate($count);
        return ProjectResource::collection($projects);
    }

    /**
     * Display a listing of the resource.
     */
    public function doneProjectsByService(int $serviceId,Request $request)
    {
        $count=@$request->count ?? 4;
        $projects=$this->interfaceProjectRepository->projectsByService($serviceId)->where("type",ProjectType::done)->paginate($count);
        return ProjectResource::collection($projects);
    }

    /**
     * Display a listing of the resource.
     */
    public function doingProject(Request $request)
    {
        $count=@$request->count ?? 4;
        $projects=$this->interfaceProjectRepository->doingProject()->paginate($count);
        return ProjectResource::collection($projects);
    }

    /**
     * Display a listing of the resource.
     */
    public function doneProject(Request $request)
    {
        $count=@$request->count ?? 4;
        $projects=$this->interfaceProjectRepository->doneProject()->paginate($count);
        return ProjectResource::collection($projects);
    }

    /**
     * Display a listing of the resource.
     */
    public function searchProjectsByType(ProjectByTypeRequest $request){
        return ProjectResource::collection($this->interfaceProjectRepository->searchProjectsByType($request->type,$request->searchedText)->get());
    }

    /**
     * Display a listing of the resource.
     */
    public function searchProjectsByTypeService(ProjectByTypeServiceRequest $request){
        return ProjectResource::collection($this->interfaceProjectRepository->searchProjectsByTypeService($request->type,$request->searchedText,$request->serviceId)->get());
    }

    /**
     * Display a listing of the resource.
     */
    public function ProjectsInfo(Request $request){
        $projects=$this->interfaceProjectRepository->getAll()->paginate(5);
        if($request->search)
            $projects=$this->interfaceProjectRepository->search($request->search)->get();

        return view("Project.index",["projects" => $projects,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services=$this->interfaceServiceRepository->getAll()->get();
        $clients=$this->interfaceClientRepository->getAll()->get();
        $tags=$this->interfaceTagRepository->getAll()->get();
        $provinces=$this->interfaceProvinceRepository->query()->get();
        $contractors=$this->interfaceContractorRepository->getAll()->get();
        return view("Project.create",["services" => $services , "clients" => $clients,"tags" => $tags,"provinces" => $provinces,"contractors" => $contractors]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProjectRequest $request)
    {
        $image=$request->file("image");
        $mobileImage=$request->file("mobileImage");
        $video=$request->file("video");
        $imagePath=UploadFunc($image,"project");
        if($video)
            $videoPath=UploadFunc($video,"project");
        if($request->showInSlider == BoolStatus::yes || $mobileImage){
            $mobileImagePath=UploadFunc($mobileImage,"project");
        }
        $data = [
            "image" => $imagePath,
            "mobile_image" => $mobileImagePath ?? null,
            "video" => $videoPath ?? null,
            "subject" => $request->subject,
            "client_id" => $request->clientId,
            "service_id" => $request->serviceId,
            "type" => $request->type,
            "started_at" => $request->startedAt,
            "finished_at" => $request->type == ProjectType::done ? $request->finishedAt : null,
            "location" => $request->location,
            "province_id" => $request->provinceId,
            "city_id" => $request->cityId,
            "is_contractor" => $request->isContractor,
            "contractor_id" => $request->isContractor == BoolStatus::yes ? null : $request->contractorId,
            "contract_duration" => $request->contractDuration ?? 0,
            "summery" => $request->summery,
            "description" => $request->description,
            "show_in_slider" => $request->showInSlider
        ];
        $newProject=$this->interfaceProjectRepository->insertData($data);
        $newProject->Tags()->sync($request->tagsList);
        if($request->showInSlider == BoolStatus::yes){
            $latestOrder=$this->interfaceSliderRepository->getLatestOrder();
            $this->interfaceSliderRepository->insertData([
                "project_id" => $newProject->id,
                "order" => $latestOrder ? $latestOrder->order+1 : 1
            ]);
        }
        if($request->galleries){
            foreach ($request->galleries as $key => $gallery){
                $newGallery=UploadFunc($gallery,"gallery");
                $this->interfaceGalleryRepository->insertData([
                    "image" => $newGallery,
                    "project_id" => $newProject->id
                ]);
            }
        }
        Session::flash('success', "پروژه با موفقیت ثبت شد");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $info=$this->interfaceProjectRepository->findById($id);
        if($info)
            return ProjectDetailResource::make($info);
        return response()->json([
            "message" => "اطلاعات نادرست است!",
            "status" => false
        ],Response::HTTP_BAD_REQUEST);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $info=$this->interfaceProjectRepository->findById($id);
        if($info){
            $services=$this->interfaceServiceRepository->getAll()->get();
            $clients=$this->interfaceClientRepository->getAll()->get();
            $tags=$this->interfaceTagRepository->getAll()->get();
            $provinces=$this->interfaceProvinceRepository->query()->get();
            $cities=$this->interfaceCityRepository->getByProvinceId($info->province_id)->get();
            $contractors=$this->interfaceContractorRepository->getAll()->get();
            return view("Project.edit",["project" => $info,"services" => $services , "clients" => $clients,"tags" =>
                $tags,"projectTags" => convertObjToArr($info->Tags,"id"),"provinces" => $provinces,"cities" => $cities,"contractors" => $contractors]);
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProjectRequest $request, int $id)
    {
        $projectInfo=$this->interfaceProjectRepository->findById($id);
        if($projectInfo){
            $imagePath=$projectInfo->image;
            $mobileImagePath=$projectInfo->mobile_image;
            $videoPath=$projectInfo->video;
            $image=$request->file("image");
            $mobileImage=$request->file("mobileImage");
            $video=$request->file("video");
            if($image){
                unlink("storage/".$projectInfo->image);
                $imagePath=UploadFunc($image,"project");
            }
            if($video){
                if($projectInfo->video)
                    unlink("storage/".$projectInfo->video);
                $videoPath=UploadFunc($video,"project");
            }
            if($request->showInSlider == BoolStatus::yes || $mobileImage){
                if($projectInfo->mobile_image)
                    unlink("storage/".$projectInfo->mobile_image);
                $mobileImagePath=UploadFunc($mobileImage,"project");
            }

            $data = [
                "image" => $imagePath,
                "mobile_image" => $mobileImagePath,
                "video" => $videoPath,
                "subject" => $request->subject,
                "client_id" => $request->clientId,
                "service_id" => $request->serviceId,
                "type" => $request->type,
                "started_at" => $request->startedAt,
                "finished_at" => $request->type == ProjectType::done ? $request->finishedAt : null,
                "location" => $request->location,
                "province_id" => $request->provinceId,
                "city_id" => $request->cityId,
                "is_contractor" => $request->isContractor,
                "contractor_id" => $request->isContractor == BoolStatus::yes ? null : $request->contractorId,
                "contract_duration" => $request->contractDuration ?? 0,
                "summery" => $request->summery,
                "description" => $request->description,
                "show_in_slider" => $request->showInSlider
            ];
            $this->interfaceProjectRepository->updateItem($id,$data);
            $project=$this->interfaceProjectRepository->findById($id);
            $project->Tags()->sync($request->tagsList);
            if($request->showInSlider == BoolStatus::yes){
                $existProject=$this->interfaceSliderRepository->checkProject($project->id)->count();
                if(!$existProject){
                    $latestOrder=$this->interfaceSliderRepository->getLatestOrder();
                    $this->interfaceSliderRepository->insertData([
                        "project_id" => $project->id,
                        "order" => $latestOrder ? $latestOrder->order+1 : 1
                    ]);
                }
            }
            else{
                $this->interfaceSliderRepository->checkProject($project->id)->delete();
            }
            Session::flash('success', "پروژه با موفقیت ویرایش شد");
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
        $project=$this->interfaceProjectRepository->findById($id);
        if($project){
            unlink("storage/".$project->image);
            if($project->video)
                unlink("storage/".$project->video);
            if($project->mobile_image)
                unlink("storage/".$project->mobile_image);
            $project->Tags()->detach();
            $projectGalleries=$project->Galleries;
            if($projectGalleries){
                foreach ($projectGalleries as $key => $projectGallery){
                    unlink("storage/".$projectGallery->image);
                    $this->interfaceGalleryRepository->deleteData($projectGallery->id);
                }
            }
            $existProject=$this->interfaceSliderRepository->checkProject($project->id)->count();
            if($existProject)
                $this->interfaceSliderRepository->checkProject($project->id)->delete();
            $this->interfaceProjectRepository->deleteData($id);
            Session::flash('success', "پروژه با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
