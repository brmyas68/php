<?php

    namespace App\Repositories\MySQL\SliderRepository;
    use App\Enums\BoolStatus;
use App\Models\Slider;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class SliderRepository extends BaseRepository implements InterfaceSliderRepository{

        /***********************
         * @var Slider $model
         ***********************/
        protected Slider $model;

        /*************************
         * @param Slider $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Slider $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function getLatestOrder(){
            return $this->query()->orderBy("order","desc")->first();
        }
        public function checkProject($projectId){
            return $this->query()->where("project_id",$projectId);
        }
        public function getActiveSliders(){
            return $this->query()->where("is_active",BoolStatus::yes)->orderBy("order","asc");
        }
    }

?>
