<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Repositories\MySQL\UserRepository\InterfaceUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * @group User
 *
 * API endpoints for User
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز کاربران را انجام دهیم.
 */
class UserController extends Controller
{
    private InterfaceUserRepository $interfaceUserRepository;
    public function __construct(InterfaceUserRepository $interfaceUserRepository){
        $this->interfaceUserRepository = $interfaceUserRepository;
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
    public function userInfo()
    {
        $userInfo=$this->interfaceUserRepository->query()->first();
        return view("User.profile",["user" => $userInfo]);
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
    public function update(UpdateRequest $request)
    {
        try {
            $newImagePath=null;
            $image=$request->file("image");
            $userImage=Auth::user()->image;
            if($image){
                if ($userImage)
                    unlink("storage/".$userImage);
                $newImagePath=UploadFunc($image,"user");
            }
            $data = [
              "image" => $newImagePath ? $newImagePath : $userImage,
              "name" => $request->name,
              "email" => $request->email,
              "username" => $request->username,
              "password" => $request->password ? Hash::make($request->password) : Auth::user()->password
            ];
            $this->interfaceUserRepository->updateItem(Auth::id(),$data);
            Session::flash('success', "اطلاعات کاربری با موفقیت ویرایش شد");
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
