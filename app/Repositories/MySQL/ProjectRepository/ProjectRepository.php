<?php

    namespace App\Repositories\MySQL\ProjectRepository;
    use App\Enums\ProjectType;
    use App\Models\Project;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class ProjectRepository extends BaseRepository implements InterfaceProjectRepository{

        /***********************
         * @var Project $model
         ***********************/
        protected Project $model;

        /*************************
         * @param Project $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Project $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function search($searchText){
            return $this->query()->where("subject","like","%{$searchText}%")->
            orWhereHas("client",function ($query) use($searchText){
                $query->where("name","like","%{$searchText}%");
            })->orWhereHas("service",function ($query) use($searchText){
                $query->where("name","like","%{$searchText}%");
            })->orderBy("id","desc");
        }

        public function doingProject(){
            return $this->query()->where("type",ProjectType::doing)->orderBy("id","desc");
        }

        public function doneProject(){
            return $this->query()->where("type",ProjectType::done)->orderBy("id","desc");
        }

        public function projectsByService(int $serviceId){
            return $this->query()->where("service_id",$serviceId)->orderBy("id","desc");
        }

        public function searchProjectsByType($type,$searchedText){
            if($type != "all")
                $querry=$this->query()->where("type",$type);
            $querry=$this->query();
            return $querry->where("subject","like","%{$searchedText}%")->orWhereHas("client",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("service",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("province",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("city",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("tag",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orderBy("id","desc");
        }

        public function searchProjectsByTypeService($type,$searchedText,$serviceId){
            if($type != "all")
                $querry=$this->query()->where("type",$type);
            $querry=$this->query();
            return $querry->where("service_id",$serviceId)->where("subject","like","%{$searchedText}%")->orWhereHas("client",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("province",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("city",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orWhereHas("tag",function ($query) use ($searchedText){
                $query->where("name","like","%{$searchedText}%");
            })->orderBy("id","desc");
        }
    }

?>
