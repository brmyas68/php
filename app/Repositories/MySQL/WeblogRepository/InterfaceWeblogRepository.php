<?php

    namespace App\Repositories\MySQL\WeblogRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceWeblogRepository extends IBaseRepository{
        public function search($searchText);
        public function weblogsByCategory(int $categoryId);
        public function searchByCategory($searchText,$categoryId);
    }

?>
