<?php

    namespace App\Repositories\MySQL\SocialMediaRepository;
    use App\Models\SocialMedia;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class SocialMediaRepository extends BaseRepository implements InterfaceSocialMediaRepository{

        /***********************
         * @var SocialMedia $model
         ***********************/
        protected SocialMedia $model;

        /*************************
         * @param SocialMedia $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(SocialMedia $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function search($searchText){
            return $this->query()->where("name","like","%{$searchText}%")->orWhere("username","like","%{$searchText}%")->orderBy("id","desc");
        }
    }

?>
