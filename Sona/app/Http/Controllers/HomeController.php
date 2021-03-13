<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Room;
use App\Models\Service;
use App\Models\Vote;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends FrontController
{
    public function index(){

        $rooms = Room::with("image","service")->where("featured",1)->get();
        $comments = Comment::with("user","commentable")->where("commentable_type","App\Models\Room")->inRandomOrder()->limit(3)->get();


        foreach ($comments as $c){
            $vote = Vote::where([
                ["user_id","=",$c->user->id],
                ["room_id","=",$c->commentable->id]
            ])->first();

            if($vote){
                $votePrint = $vote->vote;
            }else{
                $votePrint = 0;
            }

            $c->voteHtml = $this->printRatingStars($votePrint);
        }

        foreach ($rooms as $r){
            $roomServices = [];
            foreach ($r->service as $s){
                array_push($roomServices,$s->name);
            }
            $slicedRoomService = array_slice($roomServices,0,3);
            $roomServicesShort = implode(", ",$slicedRoomService);
            $r->servicesShort = $roomServicesShort."...";
        }

        $this->data["comments"] = $comments;
        $this->data["rooms"] = $rooms;
        $this->data["services"] = Service::where("featured",1)->get();
        $this->data["posts"] = Post::with("image","topic")->where("featured",1)->get();
        return view("pages.home",$this->data);
    }
}
