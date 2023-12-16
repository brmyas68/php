<?php

    namespace App\Repositories\MySQL\ClientRepository;
    use App\Models\Client;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class ClientRepository extends BaseRepository implements InterfaceClientRepository{

        /***********************
         * @var Client $model
         ***********************/
        protected Client $model;

        /*************************
         * @param Client $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Client $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
