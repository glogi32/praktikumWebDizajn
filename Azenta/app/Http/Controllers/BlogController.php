<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use Illuminate\Http\Request;

class BlogController extends FrontController
{
    private $postModel;


    public function __construct()
    {
        $this->postModel = new PostsModel();
    }

    public function blog(){
        session()->put("offset",0);
        $this->data['posts'] = $this->postModel->getAllPostsPaginate(session("offset"));
        $this->activeLink();
        return view("pages/blog",$this->data);
    }

    public function showOne($id){
        $this->data['post'] = $this->postModel->getOne($id);
        $this->data['comments'] = $this->postModel->getAllComments($id);
        $this->data["commentsNumber"] = $this->postModel->getNumberOfComments($id);

        $this->activeLink();
        return view("pages/post-single",$this->data);
    }

    public function getPostPaginate($page){

        $offset = session("offset") + $page;

        session()->put("offset",$offset);

        $data['posts'] = $this->postModel->getAllPostsPaginate(session("offset"));
        if($data['posts']) {
            return view("partials/postsBlog",$data);
        }
        else{
            return response("",500);
        }
    }

    public function insertComment(Request $request){
        $text = $request->input("Text");
        $post = $request->input("Post");
        $user = $request->input("User");

        try{
            $insertMessage = $this->postModel->insertMessage($text,$user,$post);

            return response(["insertCommentSuccess" => "Message successfully sent to agent!"],200);

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return response(["insertCommentError" => "Server error on sending comment, try again later."], 500);
        }
    }
}
