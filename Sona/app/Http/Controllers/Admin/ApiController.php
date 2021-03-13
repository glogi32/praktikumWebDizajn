<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use App\Models\Room;
use App\Models\Post;
use Illuminate\Http\Request;

class ApiController extends Controller
{

    public function getAllUsers(){
        $users = User::with("role")->get();
        foreach ($users as $u){
            $u->formatedUpdated = date("d:m:Y,  G:i",strtotime($u->updated_at));
            $u->formatedCreated = date("d:m:Y,  G:i",strtotime($u->created_at));
            $u->urlEdit = route("users.edit",$u->id);
            $u->roleName = $u->role->name;
        }

        return $users;
    }

    public function getAllRooms(){
        $rooms = Room::all();
        foreach ($rooms as $r){
            $r->formatedUpdated = date("d:m:Y,  G:i",strtotime($r->updated_at));
            $r->formatedCreated = date("d:m:Y,  G:i",strtotime($r->created_at));
            $r->urlEdit = route("rooms.edit",$r->id);

        }
        return $rooms;
    }

    public function getAllServices(){
        $services = Service::all();
        foreach ($services as $s){
            $s->formatedUpdated = date("d:m:Y,  G:i",strtotime($s->updated_at));
            $s->formatedCreated = date("d:m:Y,  G:i",strtotime($s->created_at));
            $s->urlEdit = route("services.edit",$s->id);
        }
        return $services;
    }

    public function getAllPosts(){
        $posts = Post::with("user.role")->get();
        foreach ($posts as $p){
            $p->formatedUpdated = date("d:m:Y,  G:i",strtotime($p->updated_at));
            $p->formatedCreated = date("d:m:Y,  G:i",strtotime($p->created_at));
            $p->urlEdit = route("services.edit",$p->id);
        }
        return $posts;
    }

    public function featuredRooms($id){

        $room = Room::find($id);
        if($room->featured){
            $room->featured = 0;
        }else{
            $room->featured = 1;
        }
        try{
            $room->save();
            return response("",204);
        }catch (\Exception $e){
            return response("",500);
        }
    }

    public function featuredService($id){

        $service = Service::find($id);

        if($service->featured){
            $service->featured = 0;
        }else{
            $service->featured = 1;
        }
        try{
            $service->save();
            return response("",204);
        }catch (\Exception $e){
            return response("",500);
        }
    }

    public function featuredPosts($id){
        $post = Post::find($id);

        if($post->featured){
            $post->featured = 0;
        }else{
            $post->featured = 1;
        }

        try {
            $post->save();
            return response("",204);
        }catch (\Exception $e){
            return response("",500);
        }


    }



}
