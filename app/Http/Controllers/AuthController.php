<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

/**
 * @group Auth
 *
 * API endpoints for Auth
 *
 * @subgroupDescription  می توانیم عملیات موردنیاز احراز هویت کاربر را انجام دهیم.
 */
class AuthController extends Controller
{
    public function loginPage(){
        if (Auth::check())
            return redirect()->route("dashboardPage");
        return view('login');
    }

    public function login(LoginRequest $request){
        try {
            if (!Auth::attempt(['username' => $request->username,'password' => $request->password])){
                Session::flash('fails', __('auth.failed'));
                return redirect()->back();
            }
            Auth::user()->update(["login_counts" => Auth::user()->login_counts+1]);
            return redirect()->route('dashboardPage');
        }
        catch (\Exception $ex){
            DB::rollBack();
            Log::debug($ex->getMessage() . ' - ' . $ex->getTraceAsString());
            return redirect()->back();
        }
    }

    public function forgotPassword(){
        try {
            $email=Company::first()->email;
            $newPass=rand(10000,99999);
            User::first()->update([
                "password" => Hash::make($newPass)
            ]);
            emailTo($email,[
                "name" => "پشتیبانی",
                "email" => $email,
                "subject" => "تغییر رمزعبور",
                "description" => "رمزعبور جدید شما : ".$newPass." می باشد."
            ],"MessageMail");
            Session::flash('success', "رمزعبور جدید به ایمیل شرکت ارسال شده است");
            return redirect()->back();
        }
        catch (\Exception $ex){
            DB::rollBack();
            Log::debug($ex->getMessage() . ' - ' . $ex->getTraceAsString());
            return redirect()->back();
        }
    }

    public function logout(){
        Session::flush();
        Auth::guard('web')->logout();
        return redirect()->route('loginPage');
    }
}
