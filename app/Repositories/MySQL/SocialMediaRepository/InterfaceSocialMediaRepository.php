<?php

    namespace App\Repositories\MySQL\SocialMediaRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceSocialMediaRepository extends IBaseRepository{
        public function search($searchText);
    }

?>
