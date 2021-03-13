<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends FrontController
{
    private $take;

    public function __construct()
    {
        parent::__construct();
        $this->take = 6;
    }


    public function index(){
        $this->data["posts"] = Post::with("image","topic")->skip(0)->take($this->take)->get();

        session()->put("offset",0);

        return view("pages.blog",$this->data);
    }

    public function getPostsPaginate(){

        $offset = session("offset") + 6;
        session()->put("offset",$offset);

        $posts = Post::with("image","topic")->skip($offset)->take($this->take)->get();




        foreach ($posts as $p){
            $p->formatedCreated = date("dS F, Y",strtotime($p->created_at));
            $p->routePost = route("post",$p->id);
            $p->imagePath = asset($p->image->src);
        }
        return $posts;
    }
}
