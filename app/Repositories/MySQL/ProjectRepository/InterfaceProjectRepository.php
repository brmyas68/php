<?php

    namespace App\Repositories\MySQL\ProjectRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceProjectRepository extends IBaseRepository{
        public function search($searchText);
        public function doingProject();
        public function doneProject();
        public function projectsByService(int $serviceId);
        public function searchProjectsByType($type,$searchedText);
        public function searchProjectsByTypeService($type,$searchedText,$serviceId);
    }

?>
