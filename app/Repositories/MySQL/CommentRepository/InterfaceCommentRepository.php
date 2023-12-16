<?php

    namespace App\Repositories\MySQL\CommentRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceCommentRepository extends IBaseRepository{
        public function getAllComments();
        public function getParentComments();
        public function deleteTotal($id);
        public function updateCommentSeenStatus($id);
        public function search($searchText);
        public function blogComments(int $blogId);
        public function projectComments(int $projectId);
        public function todayComments();
        public function getCommentsByStatus($status);
    }

?>
