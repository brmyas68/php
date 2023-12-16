<?php

    namespace App\Repositories\MySQL\GalleryRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceGalleryRepository extends IBaseRepository{
        public function getProjectGalleries($projectId);
    }

?>
