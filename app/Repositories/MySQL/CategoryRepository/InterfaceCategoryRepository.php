<?php

    namespace App\Repositories\MySQL\CategoryRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceCategoryRepository extends IBaseRepository{
        public function getParentCategories();
        public function deleteTotal($idsList);
    }

?>
