<?php

namespace App\Providers;

use App\Repositories\MySQL\AttributeRepository\AttributeRepository;
use App\Repositories\MySQL\AttributeRepository\InterfaceAttributeRepository;
use App\Repositories\MySQL\CategoryRepository\CategoryRepository;
use App\Repositories\MySQL\CategoryRepository\InterfaceCategoryRepository;
use App\Repositories\MySQL\CityRepository\CityRepository;
use App\Repositories\MySQL\CityRepository\InterfaceCityRepository;
use App\Repositories\MySQL\ClientRepository\ClientRepository;
use App\Repositories\MySQL\ClientRepository\InterfaceClientRepository;
use App\Repositories\MySQL\CommentRepository\CommentRepository;
use App\Repositories\MySQL\CommentRepository\InterfaceCommentRepository;
use App\Repositories\MySQL\CompanyRepository\CompanyRepository;
use App\Repositories\MySQL\CompanyRepository\InterfaceCompanyRepository;
use App\Repositories\MySQL\ContractorRepository\ContractorRepository;
use App\Repositories\MySQL\ContractorRepository\InterfaceContractorRepository;
use App\Repositories\MySQL\GalleryRepository\GalleryRepository;
use App\Repositories\MySQL\GalleryRepository\InterfaceGalleryRepository;
use App\Repositories\MySQL\MessageRepository\InterfaceMessageRepository;
use App\Repositories\MySQL\MessageRepository\MessageRepository;
use App\Repositories\MySQL\PositionRepository\InterfacePositionRepository;
use App\Repositories\MySQL\PositionRepository\PositionRepository;
use App\Repositories\MySQL\ProjectRepository\InterfaceProjectRepository;
use App\Repositories\MySQL\ProjectRepository\ProjectRepository;
use App\Repositories\MySQL\ProvinceRepository\InterfaceProvinceRepository;
use App\Repositories\MySQL\ProvinceRepository\ProvinceRepository;
use App\Repositories\MySQL\ResumeRepository\InterfaceResumeRepository;
use App\Repositories\MySQL\ResumeRepository\ResumeRepository;
use App\Repositories\MySQL\ServiceRepository\InterfaceServiceRepository;
use App\Repositories\MySQL\ServiceRepository\ServiceRepository;
use App\Repositories\MySQL\SliderRepository\InterfaceSliderRepository;
use App\Repositories\MySQL\SliderRepository\SliderRepository;
use App\Repositories\MySQL\SocialMediaRepository\InterfaceSocialMediaRepository;
use App\Repositories\MySQL\SocialMediaRepository\SocialMediaRepository;
use App\Repositories\MySQL\TagRepository\InterfaceTagRepository;
use App\Repositories\MySQL\TagRepository\TagRepository;
use App\Repositories\MySQL\TeamRepository\InterfaceTeamRepository;
use App\Repositories\MySQL\TeamRepository\TeamRepository;
use App\Repositories\MySQL\UserRepository\InterfaceUserRepository;
use App\Repositories\MySQL\UserRepository\UserRepository;
use App\Repositories\MySQL\WeblogRepository\InterfaceWeblogRepository;
use App\Repositories\MySQL\WeblogRepository\WeblogRepository;
use App\Repositories\MySQL\WorkingDaysHoursRepository\InterfaceWorkingDaysHoursRepository;
use App\Repositories\MySQL\WorkingDaysHoursRepository\WorkingDaysHoursRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InterfaceUserRepository::class,UserRepository::class);
        $this->app->bind(InterfaceCompanyRepository::class,CompanyRepository::class);
        $this->app->bind(InterfaceSocialMediaRepository::class,SocialMediaRepository::class);
        $this->app->bind(InterfaceTagRepository::class,TagRepository::class);
        $this->app->bind(InterfaceClientRepository::class,ClientRepository::class);
        $this->app->bind(InterfacePositionRepository::class,PositionRepository::class);
        $this->app->bind(InterfaceAttributeRepository::class,AttributeRepository::class);
        $this->app->bind(InterfaceServiceRepository::class,ServiceRepository::class);
        $this->app->bind(InterfaceWorkingDaysHoursRepository::class,WorkingDaysHoursRepository::class);
        $this->app->bind(InterfaceTeamRepository::class,TeamRepository::class);
        $this->app->bind(InterfaceCategoryRepository::class,CategoryRepository::class);
        $this->app->bind(InterfaceMessageRepository::class,MessageRepository::class);
        $this->app->bind(InterfaceCommentRepository::class,CommentRepository::class);
        $this->app->bind(InterfaceWeblogRepository::class,WeblogRepository::class);
        $this->app->bind(InterfaceProjectRepository::class,ProjectRepository::class);
        $this->app->bind(InterfaceGalleryRepository::class,GalleryRepository::class);
        $this->app->bind(InterfaceSliderRepository::class,SliderRepository::class);
        $this->app->bind(InterfaceResumeRepository::class,ResumeRepository::class);
        $this->app->bind(InterfaceProvinceRepository::class,ProvinceRepository::class);
        $this->app->bind(InterfaceCityRepository::class,CityRepository::class);
        $this->app->bind(InterfaceContractorRepository::class,ContractorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
