<?php

    namespace App\Repositories\MySQL\CommentRepository;
    use App\Enums\BoolStatus;
use App\Enums\CommentType;
use App\Models\Comment;
    use App\Repositories\MySQL\BaseRepository;

/**********************************************************************************
 *  It's a class for repository of BaseInfo Model
 *  It inheritance form BaseRepository for added other general methods for actions
 *  It implements from InterfaceCategoryRepository to register the rules
 *********************************************************************************/

    class CommentRepository extends BaseRepository implements InterfaceCommentRepository{

        /***********************
         * @var Comment $model
         ***********************/
        protected Comment $model;

        /*************************
         * @param Comment $model
         * pass our model to the BaseRepository
         *************************/
        public function __construct(Comment $model)
        {
            parent::__construct($model);
            $this->model = $model;
        }

        public function getAllComments(){
            return $this->query()->where("admin_reply",BoolStatus::no)->orderBy("is_seen","desc");
        }

        public function getParentComments(){
            return $this->query()->where("parent_id",0);
        }

        public function deleteTotal($id){
            return $this->query()->where("id",$id)->orWhere("parent_id",$id)->delete();
        }

        public function updateCommentSeenStatus($id){
            return $this->query()->where("id",$id)->update(["is_seen" => BoolStatus::yes]);
        }

        public function search($searchText){
            return $this->query()->where("admin_reply",BoolStatus::no)->where(function ($query) use ($searchText){
                $query->where("name","like","%{$searchText}%")->orWhere("email","like","%{$searchText}%");
            })->orderBy("id","desc");
        }

        public function blogComments(int $blogId){
            return $this->query()->where("type",CommentType::weblog)->where("type_id",$blogId)->where("parent_id",0)
                ->where("is_show",BoolStatus::yes)->orderBy("show_at","asc");
        }

        public function projectComments(int $projectId){
            return $this->query()->where("type",CommentType::project)->where("type_id",$projectId)->where("parent_id",0)
                ->where("is_show",BoolStatus::yes)->orderBy("show_at","asc");
        }

        public function todayComments(){
            return $this->query()->where("created_at","like","%".now()->format("Y-m-d")."%")->where("admin_reply",BoolStatus::no);
        }

        public function getCommentsByStatus($status){
            return $this->query()->where("is_show",$status)->orderBy("id","desc");
        }

    }

?>
