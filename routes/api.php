<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\WorkingDaysHoursController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/** Company **/
Route::group(['prefix' => 'company','as' => 'company.'],function (){
    Route::get('/',[CompanyController::class,'index'])->name('index');
});

/** SocialMedia **/
Route::group(['prefix' => 'socialmedias','as' => 'socialmedias.'],function (){
    Route::get('/',[SocialMediaController::class,"index"])->name('index');
});

/** Team **/
Route::group(['prefix' => 'teams','as' => 'teams.'],function (){
    Route::get('/',[TeamController::class,"index"])->name('index');
});

/** Attribute **/
Route::group(['prefix' => 'attributes','as' => 'attributes.'],function (){
    Route::get('/',[AttributeController::class,"index"])->name('index');
});

/** Working Days Hours **/
Route::group(['prefix' => 'dayshours','as' => 'dayshours.'],function (){
    Route::get('/',[WorkingDaysHoursController::class,"index"])->name('index');
});

/** Message **/
Route::group(['prefix' => 'messages','as' => 'messages.'],function (){
    Route::post("/store",[MessageController::class,"store"])->name('store');
});

/** Service **/
Route::group(['prefix' => 'services','as' => 'services.'],function (){
    Route::get('/',[ServiceController::class,"index"])->name('index');
    Route::get('/detail/{id}/{slug}',[ServiceController::class,"show"])->name('detail');
});

/** Resume **/
Route::group(['prefix' => 'resumes','as' => 'resumes.'],function (){
    Route::post('/store',[ResumeController::class,"store"])->name('store');
});

/** Blog **/
Route::group(['prefix' => 'blogs','as' => 'blogs.'],function (){
    Route::get('/',[WeblogController::class,"index"])->name('index');
    Route::get('/detail/{id}/{slug}',[WeblogController::class,"show"])->name('detail');
    Route::get('/by/category/{blogId}/{categoryId}',[WeblogController::class,"blogsByCategory"])->name('blogsByCategory');
    Route::post('/search',[WeblogController::class,"searched"])->name('searched');
});

/** Project **/
Route::group(['prefix' => 'projects','as' => 'projects.'],function (){
    Route::get('/',[ProjectController::class,"index"])->name('index');
    Route::get('/doing',[ProjectController::class,"doingProject"])->name('doingProject');
    Route::get('/done',[ProjectController::class,"doneProject"])->name('doneProject');
    Route::get('/detail/{id}/{slug}',[ProjectController::class,"show"])->name('detail');
    Route::get('/by/service/{serviceId}',[ProjectController::class,"projectsByService"])->name('projectsByService');
    Route::get('/doing/by/service/{serviceId}',[ProjectController::class,"doingProjectsByService"])->name('doingProjectsByService');
    Route::get('/done/by/service/{serviceId}',[ProjectController::class,"doneProjectsByService"])->name('doneProjectsByService');
    Route::post('/search/by/type',[ProjectController::class,"searchProjectsByType"])->name('searchProjectsByType');
    Route::post('/search/by/type/service',[ProjectController::class,"searchProjectsByTypeService"])->name('searchProjectsByTypeService');
});

/** Client **/
Route::group(['prefix' => 'clients','as' => 'clients.'],function (){
    Route::get('/',[ClientController::class,"index"])->name('index');
});

/** Slider **/
Route::group(['prefix' => 'sliders','as' => 'sliders.'],function (){
    Route::get('/',[SliderController::class,"index"])->name('index');
});

/** Comment **/
Route::group(['prefix' => 'comments','as' => 'comments.'],function (){
    Route::get('/project/{projectId}',[CommentController::class,"projectComments"])->name('projectComments');
    Route::get('/blog/{blogId}',[CommentController::class,"blogComments"])->name('blogComments');
    Route::post("/store",[CommentController::class,"store"])->name('store');
});

/** Captcha **/
Route::group(['prefix' => 'captcha','as' => 'captcha.'],function (){
    Route::get('/image', [CaptchaController::class,"index"])->name("index");
});
