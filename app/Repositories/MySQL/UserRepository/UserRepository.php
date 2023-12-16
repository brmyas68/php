<?php

    namespace App\Repositories\MySQL\UserRepository;
    use App\Models\User;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class UserRepository extends BaseRepository implements InterfaceUserRepository{

        /***********************
         * @var User $model
         ***********************/
        protected User $model;

        /*************************
         * @param User $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(User $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
