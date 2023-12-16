<?php

namespace App\Http\Controllers;

use App\Enums\BoolStatus;
use App\Enums\ResumeStatus;
use App\Enums\Sex;
use App\Http\Requests\Resume\DownloadResumeRequest;
use App\Http\Requests\Resume\ResumeRequest;
use App\Repositories\MySQL\ResumeRepository\InterfaceResumeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mpdf\Mpdf;
use Symfony\Component\HttpFoundation\Response;

//use Barryvdh\DomPDF\Facade\Pdf;

/**
 * @group Resume
 *
 * API endpoints for Resume
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز رزومه ها را انجام دهیم.
 */
class ResumeController extends Controller
{
    private InterfaceResumeRepository $interfaceResumeRepository;
    public function __construct(InterfaceResumeRepository $interfaceResumeRepository){
        $this->interfaceResumeRepository = $interfaceResumeRepository;
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
    public function ResumesInfo(Request $request)
    {
        $resumes=$this->interfaceResumeRepository->getAll()->paginate(7);
        if($request->search)
            $resumes=$this->interfaceResumeRepository->search($request->search)->get();
        return view("Resume.index",["resumes" => $resumes,"search" => $request->search ? true : false]);
    }

    /**
     * Download a listing of the resource.
     */
    public function downloadResumes(DownloadResumeRequest $request)
    {
        $resumes=null;
        if($request->status == '3')
            $resumes=$this->interfaceResumeRepository->getAll()->get();
        else
            $resumes=$this->interfaceResumeRepository->getResumesByStatus($request->status)->get();
        if(count($resumes)){
            $title="";
            if($request->status == ResumeStatus::confirmed)
                $title="تائید شده";
            else if ($request->status == ResumeStatus::rejected)
                $title="رد شده";
            else if($request->status == ResumeStatus::undefined)
                $title="تعیین وضعیت نشده";
            else
                $title="همه";
            $table="<table>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>نام خانوادگی</th>
                    <th>تاریخ تولد</th>
                    <th>جنسیت</th>
                    <th>شماره موبایل</th>
                    <th>ایمیل</th>
                    <th>آخرین عنوان شغلی</th>
                    <th>نام سازمان</th>
                    <th>زمینه فعالیت سازمان</th>
                    <th>تاریخ شروع</th>
                    <th>تاریخ پایان</th>
                    <th>توضیحات</th>
                    <th>تاریخ ارسال رزومه</th>
                </tr>";
            $counter=1;
            foreach($resumes as $resume){
                $table .= "<tr>
                    <th>{$counter}</th>
                    <td>{$resume->name}</td>
                    <td>{$resume->last_name}</td>
                    <td>{$resume->birthday}</td>
                    <td>";
                    if($resume->sex == Sex::female)
                        $table .= "زن";
                    else
                        $table .= "مرد";
                    $table .= "</td>
                    <td>{$resume->mobile}</td>
                    <td>{$resume->email}</td>
                    <td>{$resume->last_job_title}</td>
                    <td>{$resume->organization_name}</td>
                    <td>{$resume->activity_in_organization}</td>
                    <td>{$resume->start_date}</td>
                    <td>";
                    if($resume->still_work == \App\Enums\BoolStatus::yes)
                        $table .= "هنوز در این سازمان مشغول است";
                    else
                        $table .= $resume->finish_date;
                    $table .= "</td><td>";
                    if($resume->description)
                        $table .= $resume->description;
                    else
                        $table .= "ندارد";
                    $table .= "</td>
                        <td>".convertDateToFarsi($resume->created_at)."</td>
                    </tr>";
                $counter++;
            }
            $table .= "</table>";

            $mpdf = new Mpdf([
                'default_font_size' => 9,
                'default_font' => 'tahoma',
                'format' => 'A4-L',
            ]);

            $mpdf->setFooter('{PAGENO}');
            $mpdf->SetDirectionality('rtl');
            $mpdf->WriteHTML("
                <!DOCTYPE html>
                <html>
                    <head>
                        <style>
                            table, th, td {
                              border: 1px solid gray;
                              border-collapse: collapse;
                            }
                            table {
                                width: 100%;
                            }
                            td,th {
                              text-align: center;
                                vertical-align: middle;
                                padding: 5px 2px;
                            }
                            th {
                              background-color: #04AA6D;
                            }
                        </style>
                    </head>
                    <body>
                        <h3 class='text-muted fw-light'>لیست رزومه ها ({$title})</h3>
                        <h4>".convertDateToFarsi(now()->format("Y-m-d H:i:s"))."</h4>
                        {$table}
                    </body>
                </html>
            ");

            $mpdf->Output('resumesList-'.DateToFarsi(now()->format("Y-m-d")).'.pdf', 'D');
            Session::flash('success', "رزومه ها با موفقیت دانلود شدند");
            return redirect()->back();
        }
        Session::flash('fails', "لیست رزومه ها خالی می باشد!");
        return redirect()->back();
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
    public function store(ResumeRequest $request)
    {
        $resumeFile=$request->file("resume");
        $path=UploadFunc($resumeFile,"resume");
        $data = [
            "resume" => $path,
            "name" => $request->name,
            "last_name" => $request->lastName,
            "birthday" => $request->birthday,
            "sex" => $request->sex,
            "mobile" => $request->mobile,
            "email" => $request->email,
            "last_job_title" => $request->lastJobTitle,
            "organization_name" => $request->organizationName,
            "activity_in_organization" => $request->activityInOrganization,
            "start_date" => $request->startDate,
            "finish_date" => $request->stillWork ? ($request->stillWork == BoolStatus::yes ? null : $request->finishDate) : null,
            "still_work" => $request->stillWork,
            "description" => $request->description
        ];
        $this->interfaceResumeRepository->insertData($data);
        return response()->json([
            "message" => "رزومه شما با موفقیت ثبت شد",
            "status" => true
        ],Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $info=$this->interfaceResumeRepository->findById($id);
        if($info){
            $this->interfaceResumeRepository->updateResumeSeenStatus($id);
            return view("Resume.detail",["resume" => $info]);
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
    public function updateStatusConfirmed(int $id)
    {
        $resume=$this->interfaceResumeRepository->findById($id);
        if ($resume){
            $this->interfaceResumeRepository->updateItem($id,[
                "status" => ResumeStatus::confirmed,
                "confirmed_at" => now()->format("Y-m-d H:i:s"),
                "rejected_at" => null
            ]);
            Session::flash('success', "وضعیت رزومه موردنظر، به تائید شده تغییر پیدا کرد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStatusRejected(int $id)
    {
        $resume=$this->interfaceResumeRepository->findById($id);
        if ($resume){
            $this->interfaceResumeRepository->updateItem($id,[
                "status" => ResumeStatus::rejected,
                "rejected_at" => now()->format("Y-m-d H:i:s"),
                "confirmed_at" => null
            ]);
            Session::flash('success', "وضعیت رزومه موردنظر، به رد شده تغییر پیدا کرد");
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
        if($this->interfaceResumeRepository->deleteData($id)){
            Session::flash('success', "رزومه با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
