<?php

    namespace App\Repositories\MySQL\PositionRepository;
    use App\Models\Position;
use App\Models\Tag;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class PositionRepository extends BaseRepository implements InterfacePositionRepository{

        /***********************
         * @var Position $model
         ***********************/
        protected Position $model;

        /*************************
         * @param Position $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Position $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
