<?php

    namespace App\Repositories\MySQL\WorkingDaysHoursRepository;
    use App\Models\WorkingDaysHours;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class WorkingDaysHoursRepository extends BaseRepository implements InterfaceWorkingDaysHoursRepository{

        /***********************
         * @var WorkingDaysHours $model
         ***********************/
        protected WorkingDaysHours $model;

        /*************************
         * @param WorkingDaysHours $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(WorkingDaysHours $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
