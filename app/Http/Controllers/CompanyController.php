<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\CompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Repositories\MySQL\CompanyRepository\InterfaceCompanyRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * @group Company
 *
 * API endpoints for Company
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز اطلاعات شرکت را انجام دهیم.
 */
class CompanyController extends Controller
{
    private InterfaceCompanyRepository $interfaceCompanyRepository;
    public function __construct(InterfaceCompanyRepository $interfaceCompanyRepository){
        $this->interfaceCompanyRepository = $interfaceCompanyRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companyInfo=$this->interfaceCompanyRepository->query()->first();
        return CompanyResource::make($companyInfo);
    }

    /**
     * Display a listing of the resource.
     */
    public function companyInfo()
    {
        $companyInfo=$this->interfaceCompanyRepository->query()->first();
        return view("Company.profile",["company" => $companyInfo]);
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
    public function store(Request $request)
    {
        //
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
    public function update(CompanyRequest $request)
    {
        try {
            $companyInfo=$this->interfaceCompanyRepository->query()->first();
            $newLogoPath=null;
            $newFilmPath=null;
            $logo=$request->file("logo");
            $film=$request->file("film");
            $companyLogo=$companyInfo->logo;
            $companyFilm=$companyInfo->film;
            if($logo){
                if ($companyLogo)
                    unlink("storage/".$companyLogo);
                $newLogoPath=UploadFunc($logo,"company");
            }
            if($film){
                if ($companyFilm)
                    unlink("storage/".$companyFilm);
                $newFilmPath=UploadFunc($film,"company");
            }
            $data = [
                "name" => $request->name,
                "logo" => $newLogoPath ? $newLogoPath : $companyLogo,
                "film" => $newFilmPath ? $newFilmPath : $companyFilm,
                "email" => $request->email,
                "phone" => $request->phone,
                "mobile" => $request->mobile,
                "slogan" => $request->slogan,
                "start_year" => $request->startYear,
                "location" => $request->location,
                "address" => $request->address,
                "description" => $request->description,
                "saturday_to_wednesday" => $request->saturdayToWednesday,
                "thursday" => $request->thursday
            ];
            $this->interfaceCompanyRepository->updateItem($companyInfo->id,$data);
            Session::flash('success', "اطلاعات شرکت با موفقیت ویرایش شد");
            return redirect()->back();
        }
        catch (\Exception $exception) {
            Session::flash('fails', "message: {$exception->getMessage()} | line: {$exception->getLine()} | code: {$exception->getCode()}");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
