<?php

namespace App\Http\Controllers;

use App\Models\PostsModel;
use App\Models\PropertiesModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $userModel;
    private $propertyModel;
    private $postModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->propertyModel = new PropertiesModel();
        $this->postModel = new PostsModel();
    }

    public function getAllUsers(){
        try {

            $users = $this->userModel->getAllUsersWithRoles();
            $data['users'] = $users;
            return view("admin/partials/formUsers",$data);
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            return response(["getUsersError","Error refreshing users!"],"500");
        }
    }

    public function getAllProperties(){
        try {

            $properties = $this->propertyModel->getAllProperties();
            $data['properties'] = $properties;
            return view("admin/partials/formProperties",$data);
        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            return response(["getPropertiesError","Error refreshing properties!"],"500");
        }
    }

    public function getAllPosts(){
        try {

            $posts = $this->postModel->getAllPosts();
            $data['posts'] = $posts;
            return view("admin/partials/formPosts",$data);

        }
        catch (\Exception $e){
            \Log::error($e->getMessage());
            return response(["getPostError","Error refreshing properties!"],"500");
        }
    }


}
