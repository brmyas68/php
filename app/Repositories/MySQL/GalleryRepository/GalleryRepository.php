<?php

    namespace App\Repositories\MySQL\GalleryRepository;
    use App\Models\Gallery;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class GalleryRepository extends BaseRepository implements InterfaceGalleryRepository{

        /***********************
         * @var Gallery $model
         ***********************/
        protected Gallery $model;

        /*************************
         * @param Gallery $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Gallery $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function getProjectGalleries($projectId){
            return $this->query()->where("project_id",$projectId)->orderBy("id","desc");
        }
    }

?>
