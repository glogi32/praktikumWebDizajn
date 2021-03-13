<?php


namespace App\Models;


class PostsModel
{
    private $tablePosts = "posts";
    private $tableImagesPosts = "images_post";
    private $tableUsers = "users";
    private $tableComments = "comments";
    private $tableUserImages = "images_user";

    public function insertPost($title,$text,$id){
        return \DB::table($this->tablePosts)
            ->insertGetId([
               "title" => $title,
                "text" => $text,
                "user_id" => $id,
                "created_at" => time()
            ]);
    }

    public  function insertPostImage($path, $image_name,$postId){
        return \DB::table($this->tableImagesPosts)
            ->insertGetId([
                "src" => $path,
                "alt" => $image_name,
                "post_id" => $postId
            ]);
    }

    public function getAllPosts(){
        return \DB::table($this->tablePosts. " AS p")
            ->join($this->tableImagesPosts. " AS ip","ip.post_id","=","p.post_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->where("p.isDeleted",0)
            ->get();
    }

    public function getLatest3(){
        return \DB::table($this->tablePosts. " AS p")
            ->join($this->tableImagesPosts. " AS ip","ip.post_id","=","p.post_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->where("p.isDeleted",0)
            ->orderBy("created_at","desc")
            ->limit(3)
            ->get();
    }


    public function getAllPostsByUser($id){
        return \DB::table($this->tablePosts. " AS p")
            ->join($this->tableImagesPosts. " AS ip","ip.post_id","=","p.post_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->where([
                ["p.user_id","=",$id],
                ["p.isDeleted","=",0]
            ])
            ->get();
    }


    public function getOne($id){
        return \DB::table($this->tablePosts. " AS p")
            ->join($this->tableImagesPosts. " AS ip","ip.post_id","=","p.post_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->where([
                ["p.post_id","=",$id],
                ["p.isDeleted","=",0]
            ])
            ->first();
    }

    public function getOneWithImage($id){
        return \DB::table($this->tablePosts. " AS p")
            ->join($this->tableImagesPosts. " AS pi","p.post_id","=","pi.post_id")
            ->where([
                ['pi.post_id',"=",$id],
                ["p.isDeleted","=",0]
            ])
            ->first();
    }

    public function updatePostImage($path, $image_name, $id){
        return \DB::table($this->tableImagesPosts)
            ->where("post_id",$id)
            ->update([
                "src" => $path,
                "alt" => $image_name
            ]);
    }

    public function updatePost($title,$text,$updated_at,$idPost){
        return \DB::table($this->tablePosts)
            ->where("post_id",$idPost)
            ->update([
                "title" => $title,
                "text" => $text,
                "updated_at" => $updated_at
            ]);
    }

    public function deletePost($id){
        return \DB::table($this->tablePosts)
            ->where("post_id",$id)
            ->update([
                "isDeleted" => 1
            ]);
    }

    public function getAllPostsPaginate($offset){
        return \DB::table($this->tablePosts. " AS p")
            ->join($this->tableImagesPosts. " AS ip","ip.post_id","=","p.post_id")
            ->join($this->tableUsers. " AS u","u.user_id","=","p.user_id")
            ->where("p.isDeleted",0)
            ->offset($offset)
            ->limit(6)
            ->get();
    }

    public function insertMessage($text,$user,$post){
        return \DB::table($this->tableComments)
            ->insert([
               "text" => $text,
               "user_id" => $user,
                "post_id" => $post,
                "postTime" => time()
            ]);
    }

    public function getAllComments($postId){
        return \DB::table($this->tableComments. " AS cm")
            ->join($this->tableUsers. " AS u","u.user_id","=","cm.user_id")
            ->join($this->tableUserImages. " AS ui","u.user_id","=","ui.user_id")
            ->where("cm.post_id",$postId)
            ->orderBy("postTime","desc")
            ->get();
    }

    public function getNumberOfComments($postId){
        return \DB::table($this->tableComments)
            ->select(\DB::raw("count(*) as commentsNumber"))
            ->where("post_id",$postId)
            ->first();
    }


}
