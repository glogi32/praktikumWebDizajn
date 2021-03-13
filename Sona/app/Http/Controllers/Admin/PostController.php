<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Image;
use App\Models\Post;
use App\Models\PostTopic;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends FrontAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with("user.role")->get();
        foreach ($posts as $p){
            $p->urlEdit = route("posts.edit",$p->id);
        }
        $this->data["posts"] = $posts;
        return view("admin.pages.posts",$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data["topics"] = Topic::all();
        $this->data["form"] = "add";
        return view("admin.pages.posts",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post();

        $post->title = $request->input("title");
        $post->user_id = $request->input("user");
        $post->text = $request->input("text");
        $selectedTopics = $request->input("topics");


        DB::beginTransaction();
        $image = $request->file("image");
        $imageName = time()."_".$image->getClientOriginalName();
        $directory = public_path()."/img/posts";
        $path = "img/posts/".$imageName;

        try {
            $uploadImage = $image->move($directory,$imageName);

            $inserPost = $post->save();
            $postId = $post->id;

            $imageModel = new Image();
            $imageModel->alt = $imageName;
            $imageModel->src = $path;
            $imageModel->imageable_id = $postId;
            $imageModel->imageable_type = "App\Models\Post";

            $inserPostImage = $imageModel->save();

            if($selectedTopics){
                foreach ($selectedTopics as $s){
                    $postTopic = new PostTopic();
                    $postTopic->post_id = $postId;
                    $postTopic->topic_id = $s;
                    $postTopic->save();
                }
            }


        }catch (\Exception $e){
            \Log::error($e->getMessage());

            $this->deleteImage($path);
            $this->log("Error on admin adding post",$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertPostError" , "Server error on adding post, try again later.")->withInput();
        }

        if($inserPost && $inserPostImage){
            DB::commit();
            $this->log("Admin successfully added post with id ".$post->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertPostSuccess","Post successfully added!");
        }else{
            DB::rollBack();

            $this->deleteImage($path);
            $this->log("Error on admin adding post",$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertPostError" , "Server error on adding post, try again later.")->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with("topic")->where("id",$id)->first();

        $postTopicId = [];
        foreach ($post->topic as $t){
            array_push($postTopicId,$t->id);
        }
        $post->postTopicId = $postTopicId;


        $this->data["topics"] = Topic::all();
        $this->data["form"] = "edit";
        $this->data["post"] = $post;

        return view("admin.pages.posts",$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post = Post::with("image")->where("id",$id)->first();


        $post->title = $request->input("title");
        $post->user_id = $request->input("user");
        $post->text = $request->input("text");
        $selectedTopics = $request->input("topics");


        DB::beginTransaction();
        $image = $request->file("image");
        $imageName = time()."_".$image->getClientOriginalName();
        $directory = public_path()."/img/posts";
        $path = "img/posts/".$imageName;

        try {
            $uploadImage = $image->move($directory,$imageName);

            $updatePost = $post->save();
            $postId = $post->id;

            $imageModel = Image::find($post->image->id);
            $this->deleteImage($imageModel->src);

            $imageModel->alt = $imageName;
            $imageModel->src = $path;
            $imageModel->imageable_id = $postId;
            $imageModel->imageable_type = "App\Models\Post";

            $updatePostImage = $imageModel->save();

            $deletePostTopic = PostTopic::where("post_id",$id)->delete();


            if($selectedTopics && $deletePostTopic){



                foreach ($selectedTopics as $s){
                    $postTopic = new PostTopic();
                    $postTopic->post_id = $postId;
                    $postTopic->topic_id = $s;
                    $postTopic->save();
                }
            }


        }catch (\Exception $e){
            \Log::error($e->getMessage());

            $this->deleteImage($path);
            $this->log("Error on admin updating post with id ".$post->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("editPostError" , "Server error on editing post, try again later.")->withInput();
        }

        if($updatePost && $updatePostImage && $uploadImage){
            DB::commit();
            $this->log("Admin successfully updated post with id ".$post->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("editPostSuccess","Post successfully updated!");
        }else{
            DB::rollBack();

            $this->deleteImage($path);
            $this->log("Error on admin updating post with id ".$post->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("editPostError" , "Server error on editing post, try again later.")->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        try{
            $post = Post::find($id);
            if(!$post){
                return response("",404);
            }
            $post->delete();
            $this->log("Admin successfully deleted post with id ".$id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return response("",204);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin deleting post with id ".$id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return response("",500);
        }
    }
}
