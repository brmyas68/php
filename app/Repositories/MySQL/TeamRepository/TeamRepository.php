<?php

    namespace App\Repositories\MySQL\TeamRepository;
    use App\Models\Team;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class TeamRepository extends BaseRepository implements InterfaceTeamRepository{

        /***********************
         * @var Team $model
         ***********************/
        protected Team $model;

        /*************************
         * @param Team $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Team $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }
    }

?>
