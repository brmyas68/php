<?php

    namespace App\Repositories\MySQL\ServiceRepository;
    use App\Models\Service;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class ServiceRepository extends BaseRepository implements InterfaceServiceRepository{

        /***********************
         * @var Service $model
         ***********************/
        protected Service $model;

        /*************************
         * @param Service $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Service $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
