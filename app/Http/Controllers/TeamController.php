<?php

namespace App\Http\Controllers;

use App\Http\Requests\Team\TeamRequest;
use App\Http\Resources\Team\TeamResource;
use App\Repositories\MySQL\PositionRepository\InterfacePositionRepository;
use App\Repositories\MySQL\TeamRepository\InterfaceTeamRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * @group Team
 *
 * API endpoints for Team
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز تیم ما را انجام دهیم.
 */
class TeamController extends Controller
{
    private InterfaceTeamRepository $interfaceTeamRepository;
    private InterfacePositionRepository $interfacePositionRepository;
    public function __construct(InterfaceTeamRepository $interfaceTeamRepository,InterfacePositionRepository $interfacePositionRepository){
        $this->interfaceTeamRepository = $interfaceTeamRepository;
        $this->interfacePositionRepository = $interfacePositionRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams=$this->interfaceTeamRepository->query()->get();
        return TeamResource::collection($teams);
    }

    /**
     * Display a listing of the resource.
     */
    public function TeamsInfo(Request $request){
        $teams=$this->interfaceTeamRepository->getAll()->paginate(5);
        if($request->search)
            $teams=$this->interfaceTeamRepository->searchByColumn("name",$request->search)->get();
        return view("Team.index",["teams" => $teams,"search" => $request->search ? true : false]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $positions=$this->interfacePositionRepository->getAll()->get();
        return view("Team.create",["positions" => $positions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        $image=$request->file("image");
        $path=UploadFunc($image,"team");
        $data = [
            "image" => $path,
            "name" => $request->name
        ];
        $newTeam=$this->interfaceTeamRepository->insertData($data);
        $newTeam->Positions()->sync($request->positions);
        Session::flash('success', "فرد جدید تیم با موفقیت ثبت شد");
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
        $info=$this->interfaceTeamRepository->findById($id);
        if($info){
            $positions=$this->interfacePositionRepository->getAll()->get();
            return view("Team.edit",["team" => $info,"positions" => $positions,"teamPositions" => convertObjToArr($info->Positions,"id")]);
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, int $id)
    {
        $teamInfo=$this->interfaceTeamRepository->findById($id);
        if($teamInfo){
            $path=$teamInfo->image;
            $image=$request->file("image");
            if($image){
                unlink("storage/".$teamInfo->image);
                $path=UploadFunc($image,"team");
            }
            $data = [
                "image" => $path,
                "name" => $request->name
            ];
            $this->interfaceTeamRepository->updateItem($id,$data);
            $team=$this->interfaceTeamRepository->findById($id);
            $team->Positions()->sync($request->positions);
            Session::flash('success', "اطلاعات با موفقیت ویرایش شد");
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
        $teamInfo=$this->interfaceTeamRepository->findById($id);
        if($teamInfo){
            unlink("storage/".$teamInfo->image);
            $teamInfo->Positions()->detach();
            $this->interfaceTeamRepository->deleteData($id);
            Session::flash('success', "اطلاعات با موفقیت حذف شد");
            return redirect()->back();
        }
        Session::flash('fails', "اطلاعات نادرست است!");
        return redirect()->back();
    }
}
