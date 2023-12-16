<?php

namespace App\Http\Controllers;

use App\Http\Requests\Search\WeblogSearchRequest;
use App\Http\Requests\Weblog\WeblogRequest;
use App\Http\Resources\Weblog\WeblogResource;
use App\Repositories\MySQL\CategoryRepository\InterfaceCategoryRepository;
use App\Repositories\MySQL\ServiceRepository\InterfaceServiceRepository;
use App\Repositories\MySQL\TagRepository\InterfaceTagRepository;
use App\Repositories\MySQL\WeblogRepository\InterfaceWeblogRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Weblog
 *
 * API endpoints for Weblog
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز وبلاگ را انجام دهیم.
 */
class WeblogController extends Controller
{
    private InterfaceWeblogRepository $interfaceWeblogRepository;
    private InterfaceCategoryRepository $interfaceCategoryRepository;
    private InterfaceServiceRepository $interfaceServiceRepository;
    private InterfaceTagRepository $interfaceTagRepository;
    public function __construct(InterfaceWeblogRepository $interfaceWeblogRepository,InterfaceCategoryRepository $interfaceCategoryRepository,
    InterfaceServiceRepository $interfaceServiceRepository,InterfaceTagRepository $interfaceTagRepository){
        $this->interfaceWeblogRepository = $interfaceWeblogRepository;
        $this->interfaceCategoryRepository = $interfaceCategoryRepository;
        $this->interfaceServiceRepository = $interfaceServiceRepository;
        $this->interfaceTagRepository = $interfaceTagRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $count=@$request->count ?? 12;
        $blogs=$this->interfaceWeblogRepository->getAll()->paginate($count);
        return WeblogResource::collection($blogs);
    }

    /**
     * Display a listing of the resource.
     */
    public function blogsByCategory(int $blogId,int $categoryId,Request $request)
    {
        $count=@$request->count ?? 4;
        $blogs=$this->interfaceWeblogRepository->weblogsByCategory($categoryId)->where("id","!=",$blogId)->paginate($count);
        return WeblogResource::collection($blogs);
    }

    /**
     * Display a listing of the resource.
     */
    public function searched(WeblogSearchRequest $request)
    {
        $count=@$request->count ?? 12;
        if($request->categoryId)
            $result=$this->interfaceWeblogRepository->searchByCategory($request->searchedText,$request->categoryId);
        else
            $result=$this->interfaceWeblogRepository->search($request->searchedText);
        $blogs=$result->paginate($count);
        return WeblogResource::collection($blogs);
    }

    /**
     * Display a listing of the resource.
     */
    public function BlogsInfo(Request $request){
        $blogs=$this->interfaceWeblogRepository->getAll()->paginate(8);
        if($request->search)
            $blogs=$this->interfaceWeblogRepository->search($request->search)->get();
        return view("Blog.index",["blogs" => $blogs,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services=$this->interfaceServiceRepository->getAll()->get();
        $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
        $tags=$this->interfaceTagRepository->getAll()->get();
        return view("Blog.create",["categories" => $categories,"services" => $services,"tags" => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WeblogRequest $request)
    {
        $image=$request->file("image");
        $imagePath=UploadFunc($image,"weblog");
        $data = [
            "image" => $imagePath,
            "subject" => $request->subject,
            "category_id" => $request->categoryId,
            "service_id" => $request->serviceId,
            "description" => $request->description,
            "user_id" => Auth::id()
        ];
        $newWeblog=$this->interfaceWeblogRepository->insertData($data);
        $newWeblog->Tags()->sync($request->tagsList);
        Session::flash('success', "وبلاگ با موفقیت ثبت شد");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $info=$this->interfaceWeblogRepository->findById($id);
        if($info){
            $this->interfaceWeblogRepository->updateItem($id,[
                "views" => $info->views+1
            ]);
            return WeblogResource::make($info);
        }
        return response()->json([
            "message" => "اطلاعات نادرست است!",
            "status" => false
        ],Response::HTTP_BAD_REQUEST);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $info=$this->interfaceWeblogRepository->findById($id);
        if($info){
            $services=$this->interfaceServiceRepository->getAll()->get();
            $categories=$this->interfaceCategoryRepository->getParentCategories()->get();
            $tags=$this->interfaceTagRepository->getAll()->get();
            return view("Blog.edit",["blog" => $info,"categories" => $categories,"services" => $services,"tags" =>
                $tags,"weblogTags" => convertObjToArr($info->Tags,"id")]);
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WeblogRequest $request, int $id)
    {
        $weblogInfo=$this->interfaceWeblogRepository->findById($id);
        if($weblogInfo){
            $image=$request->file("image");
            if($image){
                unlink("storage/".$weblogInfo->image);
                $imagePath=UploadFunc($image,"weblog");
            }
            $data = [
                "image" => $image ? $imagePath : $weblogInfo->image,
                "subject" => $request->subject,
                "category_id" => $request->categoryId,
                "service_id" => $request->serviceId,
                "description" => $request->description,
            ];
            $this->interfaceWeblogRepository->updateItem($id,$data);
            $weblog=$this->interfaceWeblogRepository->findById($id);
            $weblog->Tags()->sync($request->tagsList);
            Session::flash('success', "وبلاگ با موفقیت ویرایش شد");
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
        $weblog=$this->interfaceWeblogRepository->findById($id);
        if($weblog){
            unlink("storage/".$weblog->image);
            $weblog->Tags()->detach();
            $this->interfaceWeblogRepository->deleteData($id);
            Session::flash('success', "وبلاگ با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
