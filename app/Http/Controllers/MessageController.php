<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\MessageReplyRequest;
use App\Http\Requests\Message\MessageRequest;
use App\Repositories\MySQL\CompanyRepository\InterfaceCompanyRepository;
use App\Repositories\MySQL\MessageRepository\InterfaceMessageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Message
 *
 * API endpoints for Message
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز پیام ها را انجام دهیم.
 */
class MessageController extends Controller
{
    private InterfaceMessageRepository $interfaceMessageRepository;
    private InterfaceCompanyRepository $interfaceCompanyRepository;
    public function __construct(InterfaceMessageRepository $interfaceMessageRepository,InterfaceCompanyRepository $interfaceCompanyRepository){
        $this->interfaceMessageRepository = $interfaceMessageRepository;
        $this->interfaceCompanyRepository = $interfaceCompanyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $messages=$this->interfaceMessageRepository->getAll()->where("reply_id",0)->paginate(10);
        if($request->search)
            $messages=$this->interfaceMessageRepository->search($request->search)->get();
        return view("Message.index",["messages" => $messages,"search" => $request->search ? true : false]);
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
    public function store(MessageRequest $request)
    {
        $companyInfo=$this->interfaceCompanyRepository->query()->first();
        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "description" => $request->description
        ];
        $this->interfaceMessageRepository->insertData($data);
//        emailTo($companyInfo->email,$data,"MessageMail");
        return response()->json([
            "message" => "پیام شما با موفقیت ثبت شد",
            "status" => true
        ],Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function reply(MessageReplyRequest $request)
    {
        $messageInfo=$this->interfaceMessageRepository->findById($request->replyId);
        if($messageInfo){
            $companyInfo=$this->interfaceCompanyRepository->query()->first();
            $data = [
                "name" => $companyInfo->name,
                "email" => $companyInfo->email,
                "subject" => $request->subject,
                "description" => $request->description,
                "reply_id" => $request->replyId
            ];
            $this->interfaceMessageRepository->insertData($data);
//            emailTo($messageInfo->email,$data,"MessageMail");
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
        $info=$this->interfaceMessageRepository->findById($id);
        if($info){
            $this->interfaceMessageRepository->updateMessageSeenStatus($id);
            return view("Message.detail",["message" => $info]);
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
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if($this->interfaceMessageRepository->deleteTotal($id)){
            Session::flash('success', "پیام با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
