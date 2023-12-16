<?php

    namespace App\Repositories\MySQL\TagRepository;
    use App\Models\Tag;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class TagRepository extends BaseRepository implements InterfaceTagRepository{

        /***********************
         * @var Tag $model
         ***********************/
        protected Tag $model;

        /*************************
         * @param Tag $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Tag $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
