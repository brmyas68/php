<?php

    namespace App\Repositories\MySQL\MessageRepository;
    use App\Enums\BoolStatus;
    use App\Models\Message;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class MessageRepository extends BaseRepository implements InterfaceMessageRepository{

        /***********************
         * @var Message $model
         ***********************/
        protected Message $model;

        /*************************
         * @param Message $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Message $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function updateMessageSeenStatus($id){
            return $this->query()->where("id",$id)->orWhere("reply_id",$id)->update(["is_seen" => BoolStatus::yes]);
        }

        public function deleteTotal($id){
            return $this->query()->where("id",$id)->orWhere("reply_id",$id)->delete();
        }

        public function search($searchText){
            return $this->query()->where("reply_id",0)->where("name","like","%{$searchText}%")->orWhere("email","like","%{$searchText}%")->orderBy("id","desc");
        }

        public function todayMessages(){
            return $this->query()->where("created_at","like","%".now()->format("Y-m-d")."%")->where("reply_id",0);
        }
    }

?>
