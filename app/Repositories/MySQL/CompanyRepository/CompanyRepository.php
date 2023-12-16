<?php

    namespace App\Repositories\MySQL\CompanyRepository;
    use App\Models\Company;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class CompanyRepository extends BaseRepository implements InterfaceCompanyRepository {

        /***********************
         * @var Company $model
         ***********************/
        protected Company $model;

        /*************************
         * @param Company $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Company $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
