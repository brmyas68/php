<?php

    namespace App\Repositories\MySQL\MessageRepository;
    use App\Repositories\MySQL\IBaseRepository;

    interface InterfaceMessageRepository extends IBaseRepository{
        public function updateMessageSeenStatus($id);
        public function deleteTotal($id);
        public function search($searchText);
        public function todayMessages();
    }

?>
