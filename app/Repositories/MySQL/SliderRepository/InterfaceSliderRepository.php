<?php

    namespace App\Repositories\MySQL\SliderRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceSliderRepository extends IBaseRepository{
        public function getLatestOrder();
        public function checkProject($projectId);
        public function getActiveSliders();
    }

?>
