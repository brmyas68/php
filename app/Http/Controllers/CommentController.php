<?php

namespace App\Http\Controllers;

use App\Enums\BoolStatus;
use App\Http\Requests\Comment\CommentReplyRequest;
use App\Http\Requests\Comment\CommentRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Repositories\MySQL\CommentRepository\InterfaceCommentRepository;
use App\Repositories\MySQL\CompanyRepository\InterfaceCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Comment
 *
 * API endpoints for Comment
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز نظرات را انجام دهیم.
 */
class CommentController extends Controller
{
    private InterfaceCommentRepository $interfaceCommentRepository;
    private InterfaceCompanyRepository $interfaceCompanyRepository;
    public function __construct(InterfaceCommentRepository $interfaceCommentRepository,InterfaceCompanyRepository $interfaceCompanyRepository){
        $this->interfaceCommentRepository = $interfaceCommentRepository;
        $this->interfaceCompanyRepository = $interfaceCompanyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $comments=$this->interfaceCommentRepository->getAllComments()->paginate(8);
        if($request->search)
            $comments=$this->interfaceCommentRepository->search($request->search)->get();
        return view("Comment.index",["comments" => $comments,"search" => $request->search ? true : false]);
    }

    /**
     * Display a listing of the resource.
     */
    public function projectComments(int $projectId,Request $request)
    {
        $count=@$request->count ?? 4;
        $comments=$this->interfaceCommentRepository->projectComments($projectId)->paginate($count);
        return CommentResource::collection($comments);
    }

    /**
     * Display a listing of the resource.
     */
    public function blogComments(int $blogId,Request $request)
    {
        $count=@$request->count ?? 4;
        $comments=$this->interfaceCommentRepository->blogComments($blogId)->paginate($count);
        return CommentResource::collection($comments);
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
    public function store(CommentRequest $request)
    {
        $companyInfo=$this->interfaceCompanyRepository->query()->first();
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "comment" => $request->comment,
            "parent_id" => $request->parentId,
            "type" => $request->type,
            "type_id" => $request->typeId
        ];
        $this->interfaceCommentRepository->insertData($data);
        $data["parentComment"]=$request->parentId != 0 ? $this->interfaceCommentRepository->findById($request->parentId)->comment : "نظر والد";
        $data["typeSubject"]="";
//        emailTo($companyInfo->email,$data,"CommentMail");
        return response()->json([
            "message" => "نظرشما با موفقیت ثبت شد و پس از تائید ادمین نمایش داده می شود" ,
            "status" => true
        ],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function reply(CommentReplyRequest $request)
    {
        $commentInfo=$this->interfaceCommentRepository->findById($request->replyId);
        if($commentInfo){
            $companyInfo=$this->interfaceCompanyRepository->query()->first();
            $data = [
                "name" => $companyInfo->name,
                "email" => $companyInfo->email,
                "comment" => $request->comment,
                "parent_id" => $request->replyId,
                "type" => $commentInfo->type,
                "type_id" => $commentInfo->type_id,
                "admin_reply" => BoolStatus::yes,
                "is_seen" => BoolStatus::yes
            ];
            $this->interfaceCommentRepository->insertData($data);
            $data["parentComment"]=$commentInfo->comment;
            $data["typeSubject"]="";
//            emailTo($commentInfo->email,$data,"CommentMail");
            Session::flash('success', "پیام با موفقیت ثبت و ایمیل ارسال شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $info=$this->interfaceCommentRepository->findById($id);
        if($info){
            $this->interfaceCommentRepository->updateCommentSeenStatus($id);
            return view("Comment.detail",["comment" => $info]);
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
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
     * Update the specified resource in storage.
     */
    public function updateShowStatusShow(int $id)
    {
        $data = [
            "is_show" => BoolStatus::yes,
            "show_at" => now()->format('Y-m-d H:i:s')
        ];
        $this->interfaceCommentRepository->updateItem($id,$data);
        Session::flash('success', "وضعیت نمایشی کامنت با موفقیت ویرایش شد");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateShowStatusNotShow(int $id)
    {
        $data = [
            "is_show" => BoolStatus::no,
            "show_at" => null
        ];
        $this->interfaceCommentRepository->updateItem($id,$data);
        Session::flash('success', "وضعیت نمایشی کامنت با موفقیت ویرایش شد");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if($this->interfaceCommentRepository->deleteTotal($id)){
            Session::flash('success', "نظر با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
