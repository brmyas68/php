<?php

namespace App\Http\Controllers;

use App\Enums\BoolStatus;
use App\Enums\ResumeStatus;
use App\Repositories\MySQL\ClientRepository\InterfaceClientRepository;
use App\Repositories\MySQL\CommentRepository\InterfaceCommentRepository;
use App\Repositories\MySQL\MessageRepository\InterfaceMessageRepository;
use App\Repositories\MySQL\ProjectRepository\InterfaceProjectRepository;
use App\Repositories\MySQL\ResumeRepository\InterfaceResumeRepository;
use App\Repositories\MySQL\ServiceRepository\InterfaceServiceRepository;
use App\Repositories\MySQL\WeblogRepository\InterfaceWeblogRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private InterfaceMessageRepository $interfaceMessageRepository;
    private InterfaceCommentRepository $interfaceCommentRepository;
    private InterfaceResumeRepository $interfaceResumeRepository;
    private InterfaceProjectRepository $interfaceProjectRepository;
    private InterfaceClientRepository $interfaceClientRepository;
    private InterfaceServiceRepository $interfaceServiceRepository;
    private InterfaceWeblogRepository $interfaceWeblogRepository;
    public function __construct(InterfaceMessageRepository $interfaceMessageRepository,InterfaceCommentRepository $interfaceCommentRepository,InterfaceResumeRepository
    $interfaceResumeRepository,InterfaceProjectRepository $interfaceProjectRepository,InterfaceClientRepository $interfaceClientRepository,InterfaceServiceRepository
    $interfaceServiceRepository,InterfaceWeblogRepository $interfaceWeblogRepository){
        $this->interfaceMessageRepository = $interfaceMessageRepository;
        $this->interfaceCommentRepository = $interfaceCommentRepository;
        $this->interfaceResumeRepository = $interfaceResumeRepository;
        $this->interfaceProjectRepository = $interfaceProjectRepository;
        $this->interfaceClientRepository = $interfaceClientRepository;
        $this->interfaceServiceRepository = $interfaceServiceRepository;
        $this->interfaceWeblogRepository = $interfaceWeblogRepository;
    }
    public function dashboardPage(){
        $allClients=$this->interfaceClientRepository->getAll()->count();
        $allServices=$this->interfaceServiceRepository->getAll()->count();
        $allProjects=$this->interfaceProjectRepository->getAll()->count();
        $allWeblogs=$this->interfaceWeblogRepository->getAll()->count();
        $allResumes=$this->interfaceResumeRepository->getAll()->count();
        $allComments=$this->interfaceCommentRepository->query()->where("admin_reply",BoolStatus::no)->count();
        $allMessages=$this->interfaceMessageRepository->query()->where("reply_id",0)->count();
        $todayMessages=$this->interfaceMessageRepository->todayMessages()->count();
        $todayComments=$this->interfaceCommentRepository->todayComments()->count();
        $todayResumes=$this->interfaceResumeRepository->todayResumes()->count();
        $undefinedResumes=$this->interfaceResumeRepository->getResumesByStatus(ResumeStatus::undefined)->count();
        $notShowComments=$this->interfaceCommentRepository->getCommentsByStatus(BoolStatus::no)->count();

        return view("dashboard",[
            "allClients" => $allClients,
            "allServices" => $allServices,
            "allProjects" => $allProjects,
            "allWeblogs" => $allWeblogs,
            "allResumes" => $allResumes,
            "allComments" => $allComments,
            "allMessages" => $allMessages,
            "todayMessages" => $todayMessages,
            "todayComments" => $todayComments,
            "todayResumes" => $todayResumes,
            "undefinedResumes" => $undefinedResumes,
            "notShowComments" => $notShowComments
        ]);
    }
}
