<?php

    namespace App\Repositories\MySQL\ResumeRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceResumeRepository extends IBaseRepository{
        public function updateResumeSeenStatus($id);
        public function getResumesByStatus($status);
        public function search($searchText);
        public function todayResumes();
    }

?>
