<?php

    namespace App\Repositories\MySQL\AttributeRepository;
    use App\Models\Attribute;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class AttributeRepository extends BaseRepository implements InterfaceAttributeRepository{

        /***********************
         * @var Attribute $model
         ***********************/
        protected Attribute $model;

        /*************************
         * @param Attribute $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Attribute $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
