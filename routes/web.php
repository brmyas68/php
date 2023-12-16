<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkingDaysHoursController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\WeblogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ContractorController;
use App\Http\Controllers\CityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/forgot/password', [AuthController::class,'forgotPassword'])->name('forgotPassword');

Route::middleware(['auth:sanctum','panel'])->group(function (){
    Route::get('/dashboard', [DashboardController::class,'dashboardPage'])->name('dashboardPage');
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');
    /** User **/
    Route::group(['prefix' => 'user','as' => 'user.'],function (){
        Route::get('/info',[UserController::class,'userInfo'])->name('userInfo');
        Route::post('/update',[UserController::class,'update'])->name('update');
    });
    /** Company **/
    Route::group(['prefix' => 'company','as' => 'company.'],function (){
        Route::get('/info',[CompanyController::class,'companyInfo'])->name('companyInfo');
        Route::post('/update',[CompanyController::class,'update'])->name('update');
    });
    /** SocialMedia **/
    Route::group(['prefix' => 'socialmedias','as' => 'socialmedias.'],function (){
        Route::get('/info',[SocialMediaController::class,"SocialMediasInfo"])->name('SocialMediasInfo');
        Route::get('/create',[SocialMediaController::class,"create"])->name('create');
        Route::post("/store",[SocialMediaController::class,"store"])->name('store');
        Route::get('/edit/{id}',[SocialMediaController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[SocialMediaController::class,"update"])->name('update');
        Route::get("/delete/{id}",[SocialMediaController::class,"destroy"])->name('destroy');
    });
    /** Tag **/
    Route::group(['prefix' => 'tags','as' => 'tags.'],function (){
        Route::get('/info',[TagController::class,"TagsInfo"])->name('TagsInfo');
        Route::get('/create',[TagController::class,"create"])->name('create');
        Route::post("/store",[TagController::class,"store"])->name('store');
        Route::get('/edit/{id}',[TagController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[TagController::class,"update"])->name('update');
        Route::get("/delete/{id}",[TagController::class,"destroy"])->name('destroy');
    });
    /** Client **/
    Route::group(['prefix' => 'clients','as' => 'clients.'],function (){
        Route::get('/info',[ClientController::class,"ClientsInfo"])->name('ClientsInfo');
        Route::get('/create',[ClientController::class,"create"])->name('create');
        Route::post("/store",[ClientController::class,"store"])->name('store');
        Route::get('/edit/{id}',[ClientController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[ClientController::class,"update"])->name('update');
        Route::get("/delete/{id}",[ClientController::class,"destroy"])->name('destroy');
    });
    /** Client **/
        Route::group(['prefix' => 'contractors','as' => 'contractors.'],function (){
        Route::get('/info',[ContractorController::class,"ContractorsInfo"])->name('ContractorsInfo');
        Route::get('/create',[ContractorController::class,"create"])->name('create');
        Route::post("/store",[ContractorController::class,"store"])->name('store');
        Route::get('/edit/{id}',[ContractorController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[ContractorController::class,"update"])->name('update');
        Route::get("/delete/{id}",[ContractorController::class,"destroy"])->name('destroy');
    });
    /** Position **/
    Route::group(['prefix' => 'positions','as' => 'positions.'],function (){
        Route::get('/info',[PositionController::class,"PositionsInfo"])->name('PositionsInfo');
        Route::get('/create',[PositionController::class,"create"])->name('create');
        Route::post("/store",[PositionController::class,"store"])->name('store');
        Route::get('/edit/{id}',[PositionController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[PositionController::class,"update"])->name('update');
        Route::get("/delete/{id}",[PositionController::class,"destroy"])->name('destroy');
    });
    /** Attribute **/
    Route::group(['prefix' => 'attributes','as' => 'attributes.'],function (){
        Route::get('/info',[AttributeController::class,"AttributesInfo"])->name('AttributesInfo');
        Route::get('/create',[AttributeController::class,"create"])->name('create');
        Route::post("/store",[AttributeController::class,"store"])->name('store');
        Route::get('/edit/{id}',[AttributeController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[AttributeController::class,"update"])->name('update');
        Route::get("/delete/{id}",[AttributeController::class,"destroy"])->name('destroy');
    });
    /** Service **/
    Route::group(['prefix' => 'services','as' => 'services.'],function (){
        Route::get('/info',[ServiceController::class,"ServicesInfo"])->name('ServicesInfo');
        Route::get('/create',[ServiceController::class,"create"])->name('create');
        Route::post("/store",[ServiceController::class,"store"])->name('store');
        Route::get('/edit/{id}',[ServiceController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[ServiceController::class,"update"])->name('update');
        Route::get("/delete/{id}",[ServiceController::class,"destroy"])->name('destroy');
    });
    /** Working Days Hours **/
    Route::group(['prefix' => 'dayshours','as' => 'dayshours.'],function (){
        Route::get('/info',[WorkingDaysHoursController::class,"DaysHoursInfo"])->name('DaysHoursInfo');
        Route::get('/edit/{id}',[WorkingDaysHoursController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[WorkingDaysHoursController::class,"update"])->name('update');
    });
    /** Team **/
    Route::group(['prefix' => 'teams','as' => 'teams.'],function (){
        Route::get('/info',[TeamController::class,"TeamsInfo"])->name('TeamsInfo');
        Route::get('/create',[TeamController::class,"create"])->name('create');
        Route::post("/store",[TeamController::class,"store"])->name('store');
        Route::get('/edit/{id}',[TeamController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[TeamController::class,"update"])->name('update');
        Route::get("/delete/{id}",[TeamController::class,"destroy"])->name('destroy');
    });
    /** Category **/
    Route::group(['prefix' => 'categories','as' => 'categories.'],function (){
        Route::get('/info',[CategoryController::class,"CategoriesInfo"])->name('CategoriesInfo');
        Route::get('/create',[CategoryController::class,"create"])->name('create');
        Route::post("/store",[CategoryController::class,"store"])->name('store');
        Route::get('/edit/{id}',[CategoryController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[CategoryController::class,"update"])->name('update');
        Route::get("/delete/{id}",[CategoryController::class,"destroy"])->name('destroy');
        Route::post("/total/delete",[CategoryController::class,"totalDelete"])->name('totalDelete');
    });
    /** Message **/
    Route::group(['prefix' => 'messages','as' => 'messages.'],function (){
        Route::get('/',[MessageController::class,"index"])->name('index');
        Route::get('/show/{id}',[MessageController::class,"show"])->name('show');
        Route::post("/reply",[MessageController::class,"reply"])->name('reply');
        Route::get("/delete/{id}",[MessageController::class,"destroy"])->name('destroy');
    });
    /** Comment **/
    Route::group(['prefix' => 'comments','as' => 'comments.'],function (){
        Route::get('/',[CommentController::class,"index"])->name('index');
        Route::get('/show/{id}',[CommentController::class,"show"])->name('show');
        Route::post("/reply",[CommentController::class,"reply"])->name('reply');
        Route::get("/update/show/status/show/{id}",[CommentController::class,"updateShowStatusShow"])->name('updateShowStatusShow');
        Route::get("/update/show/status/notshow/{id}",[CommentController::class,"updateShowStatusNotShow"])->name('updateShowStatusNotShow');
        Route::get("/delete/{id}",[CommentController::class,"destroy"])->name('destroy');
    });
    /** Blog **/
    Route::group(['prefix' => 'blogs','as' => 'blogs.'],function (){
        Route::get('/info',[WeblogController::class,"BlogsInfo"])->name('BlogsInfo');
        Route::get('/create',[WeblogController::class,"create"])->name('create');
        Route::post("/store",[WeblogController::class,"store"])->name('store');
        Route::get('/edit/{id}',[WeblogController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[WeblogController::class,"update"])->name('update');
        Route::get("/delete/{id}",[WeblogController::class,"destroy"])->name('destroy');
    });
    /** Gallery **/
    Route::group(['prefix' => 'galleries','as' => 'galleries.'],function (){
        Route::get('/project/{id}',[GalleryController::class,"projectGalleries"])->name('projectGalleries');
        Route::post("/store",[GalleryController::class,"store"])->name('store');
        Route::get("/delete/{id}",[GalleryController::class,"destroy"])->name('destroy');
    });
    /** Project **/
    Route::group(['prefix' => 'projects','as' => 'projects.'],function (){
        Route::get('/info',[ProjectController::class,"ProjectsInfo"])->name('ProjectsInfo');
        Route::get('/create',[ProjectController::class,"create"])->name('create');
        Route::post("/store",[ProjectController::class,"store"])->name('store');
        Route::get('/edit/{id}',[ProjectController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[ProjectController::class,"update"])->name('update');
        Route::get("/delete/{id}",[ProjectController::class,"destroy"])->name('destroy');
    });
    /** Slider **/
    Route::group(['prefix' => 'sliders','as' => 'sliders.'],function (){
        Route::get('/info',[SliderController::class,"SlidesInfo"])->name('SlidesInfo');
        Route::get('/add/project/page',[SliderController::class,"addProjectPage"])->name('addProjectPage');
        Route::get('/create',[SliderController::class,"create"])->name('create');
        Route::post("/store",[SliderController::class,"store"])->name('store');
        Route::post("/store/add/project",[SliderController::class,"addProject"])->name('addProject');
        Route::get('/edit/{id}',[SliderController::class,"edit"])->name('edit');
        Route::post("/update/{id}",[SliderController::class,"update"])->name('update');
        Route::get("/delete/{id}",[SliderController::class,"destroy"])->name('destroy');
    });
    /** Resume **/
    Route::group(['prefix' => 'resumes','as' => 'resumes.'],function (){
        Route::get('/info',[ResumeController::class,"ResumesInfo"])->name('ResumesInfo');
        Route::get('/detail/{id}',[ResumeController::class,"show"])->name('detail');
        Route::post('/download',[ResumeController::class,"downloadResumes"])->name('downloadResumes');
        Route::get("/update/confirmed/{id}",[ResumeController::class,"updateStatusConfirmed"])->name('updateStatusConfirmed');
        Route::get("/update/rejected/{id}",[ResumeController::class,"updateStatusRejected"])->name('updateStatusRejected');
        Route::get("/delete/{id}",[ResumeController::class,"destroy"])->name('destroy');
    });
    /** City **/
    Route::group(['prefix' => 'cities','as' => 'cities.'],function (){
        Route::get('/by/province/{cityId}',[CityController::class,"citiesByProvince"])->name('citiesByProvince');
    });
});
