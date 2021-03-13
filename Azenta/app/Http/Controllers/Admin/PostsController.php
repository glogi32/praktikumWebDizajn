<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\PostsModel;
use Illuminate\Http\Request;

class PostsController extends BackController
{
    private $postModel;

    public function __construct()
    {
        $this->postModel = new PostsModel();
        parent::__construct();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(session("user")->role_id == 3){
            $this->data['posts'] = $this->postModel->getAllPostsByUser(session("user")->user_id);
        }else{
            $this->data['posts'] = $this->postModel->getAllPosts();
        }
        return view("admin/pages/posts",$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = "insert";

        return view("admin/pages/posts", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $title = $request->input("Title");
        $text = $request->input("Text");
        $id = $request->input("idUser");

        \DB::beginTransaction();
        try {
            $image = $request->file("Image");
            $image_name = $image->getClientOriginalName()."_".time();
            $directory = \public_path()."/img/posts";
            $image->move($directory,$image_name);

            $path = "img/posts/".$image_name;

            $insertPostId = $this->postModel->insertPost($title,$text,$id);
            $insertImage = $this->postModel->insertPostImage($path, $image_name,$insertPostId);

        }
        catch (\Exception $e){

            \Log::error($e->getMessage());
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed adding post!");
            return redirect()->back()->with("insertPostError" , "Server error, try again later.");
        }
        if($insertImage && $insertPostId){

            \DB::commit();
            \LogActivity::addToLog($request,"User successfully added post!");
            return redirect()->back()->with("insertPostSuccess","Post added successfully!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed adding post!");
            return redirect()->back()->with("insertPostError" , "Server error, try again later.");
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
        $this->data["post"] = $this->postModel->getOne($id);
        $this->data['form'] = "edit";
        return view("admin/pages/posts",$this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $title = $request->input("Title");
        $text = $request->input("Text");
        $updated_at = time();



        \DB::beginTransaction();
        try {
            $image = $request->file("Image");
            if($image) {
                $image_name = $image->getClientOriginalName() . "_" . time();
                $directory = \public_path() . "/img/posts";
                $image->move($directory, $image_name);

                $user = $this->postModel->getOneWithImage($id);
                $this->deleteImage($user->src);

                $path = "img/posts/" . $image_name;
                $Image = $this->postModel->updatePostImage($path, $image_name, $id);
            }

            $Post = $this->postModel->updatePost($title,$text,$updated_at,$id);


        }
        catch (\Exception $e){

            \Log::error($e->getMessage());
            \LogActivity::addToLog($request,"User failed updating post!");
            return redirect()->back()->with("editError" , "Server error on edit post, try again later.");
        }
        if($Post){

            \DB::commit();
            \LogActivity::addToLog($request,"User successfully updated post!");
            return redirect()->back()->with("editSuccess","Post changed successfully!");
        }else{
            \DB::rollBack();
            \LogActivity::addToLog($request,"User failed updating post!");
            return redirect()->back()->with("editError" , "Server error on edit post, try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {

        try{

            $delete = $this->postModel->deletePost($id);
            if(!$delete){
                return response(["deleteError", "Error on deleting post, post not found!"],404);
                \LogActivity::addToLog($request,"User failed deleting post!");
            }
            \LogActivity::addToLog($request,"User successfully deleted post!");
            return response(["deleteSuccess","Post successfully deleted"],200);
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            \LogActivity::addToLog($request,"User failed deleting post!");
            return response(["deleteError", "Error on deleting post, try again later!"],500);
        }
    }
}
