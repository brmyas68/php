<?php

    namespace App\Repositories\MySQL\ContractorRepository;
    use App\Models\Contractor;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class ContractorRepository extends BaseRepository implements InterfaceContractorRepository{

        /***********************
         * @var Contractor $model
         ***********************/
        protected Contractor $model;

        /*************************
         * @param Contractor $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Contractor $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
