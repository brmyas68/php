<?php

    namespace App\Repositories\MySQL\ResumeRepository;
    use App\Enums\BoolStatus;
use App\Models\Resume;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class ResumeRepository extends BaseRepository implements InterfaceResumeRepository{

        /***********************
         * @var Resume $model
         ***********************/
        protected Resume $model;

        /*************************
         * @param Resume $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Resume $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function updateResumeSeenStatus($id){
            return $this->query()->where("id",$id)->update(["is_seen" => BoolStatus::yes]);
        }

        public function getResumesByStatus($status){
            return $this->query()->where("status",$status)->orderBy("id","desc");
        }

        public function search($searchText){
            return $this->query()->where("email","like","%{$searchText}%")->orWhere("mobile","like","%{$searchText}%")->
            orWhere("name","like","%{$searchText}%")->orWhere("last_name","like","%{$searchText}%")->orderBy("id","desc");
        }

        public function todayResumes(){
            return $this->query()->where("created_at","like","%".now()->format("Y-m-d")."%");
        }
    }

?>
