<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends FrontController
{
    public function index($id){
        $this->data["post"] = Post::with("image","topic","user","comment.user.image")->where("id",$id)->first();
        $this->data["featuredPosts"] = Post::with("image","topic")->where("featured",1)->get();


        return view("pages.post",$this->data);
    }

    public function insertComment(Request $request){
        $text = $request->input("text");
        if(!$text){
            return response(["error" => "Comment filed cant be empty!"],422);
        }
        $comment = new Comment();
        $comment->text = $text;
        $comment->user_id = $request->input("userId");
        $comment->commentable_id = $request->input("postId");
        $comment->commentable_type = "App\Models\Post";

        $inserComment = $comment->save();

        if($inserComment){
            $this->log("User successfully added comment with id ".$comment->id,$request);
            return response("",204);
        }else{
            $this->log("Error on user adding comment",$request);
            return response(["error" => "Server error, try again later!"],500);
        }
    }

    public function deleteComment($id,Request $request){
        $comment = Comment::find($id);
        if(!$comment){
            return response("",404);
        }

        try{
            $comment->delete();
            $this->log("Admin successfully deleted comment with id ".$comment->id,$request);
            return response("",204);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin trying to delete comment with id ".$comment->id,$request);
            return response("",500);
        }
    }
}
