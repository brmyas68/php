<?php

    namespace App\Repositories\MySQL\WeblogRepository;
    use App\Models\Weblog;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class WeblogRepository extends BaseRepository implements InterfaceWeblogRepository{

        /***********************
         * @var Weblog $model
         ***********************/
        protected Weblog $model;

        /*************************
         * @param Weblog $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Weblog $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function search($searchText){
            return $this->query()->where("subject","like","%{$searchText}%")->orWhereHas("category",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orWhereHas("service",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orWhereHas("tag",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orderBy("id","desc");
        }

        public function searchByCategory($searchText,$categoryId){
            return $this->query()->where("category_id",$categoryId)->orWhere("subject","like","%{$searchText}%")
                ->orWhereHas("service",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orWhereHas("tag",function ($query) use($searchText){
                    $query->where("name","like","%{$searchText}%");
                })->orderBy("id","desc");
        }

        public function weblogsByCategory(int $categoryId){
            return $this->query()->where("category_id",$categoryId)->orderBy("id","desc");
        }
    }

?>
