<?php

    namespace App\Repositories\MySQL\ProjectPropertyRepository;
    use App\Models\ProjectProperty;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class ProjectPropertyRepository extends BaseRepository implements InterfaceProjectPropertyRepository{

        /***********************
         * @var ProjectProperty $model
         ***********************/
        protected ProjectProperty $model;

        /*************************
         * @param ProjectProperty $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(ProjectProperty $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
