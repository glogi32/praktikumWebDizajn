<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class RoomDetailsController extends FrontController
{
    public function roomDetails($id)
    {
        $rooms = Room::with("image","service","vote.user","comment.user.image","comment.user.vote")->where("id",$id)->first();


        foreach($rooms->comment as $c){
            $vote = Vote::where([
                ["user_id","=",$c->user->id],
                ["room_id","=",$id]
            ])->first();


            if($vote){
                $votePrint = $vote->vote;
            }else{
                $votePrint = 0;
            }

            $c->voteHtml = $this->printRatingStars($votePrint);
        }



        $servicesArray = [];
        foreach ($rooms->service as $s){
            array_push($servicesArray,$s->name);
        }
        $rooms->services = implode(", ",$servicesArray);


        if(count($rooms->vote)) {
            $sum = 0;
            foreach ($rooms->vote as $r) {
                $sum += $r->vote;
            }
            $avgVote = $sum / count($rooms->vote);
        }else{
            $avgVote = 0;
        }

        $html = $this->printRatingStars($avgVote);

        $rooms->html = $html;

        $this->data['room'] = $rooms;


        return view("pages.room-details",$this->data);
    }


    public function makeReservation(Request $request){

        $check_in = $request->input("checkInDate");
        $check_out = $request->input("checkOutDate");
        $persons = intval($request->input("adults")) + intval($request->input("children"));

        if(!$request->input("userId")){
            return response(null,401);
        }
        if(!$check_in || !$check_out){
            return response(["error" => "You need to fill check in and check out fields!"],422);
        }
        if(date("d:m:Y",strtotime($check_in)) >= date("d:m:Y",strtotime($check_out))){
            return response(["error" => "Check in date can't be bigger then check out date!"],422);
        }


        $room = Room::with("service")->where("id",$request->input("roomId"))->first();

        $reservations = Reservation::where("room_id",$request->input("roomId"))->orderBy("check_out","desc")->get();


        if($room->available_rooms == 0){
            $this->log("User successfully made reservation for room with id ".$room->id,$request);
            return response(["error" => "All ".$room->name." rooms are currently not available! Next available date is after ".$reservations[0]->check_out],422);
        }
        if($persons > $room->max_persons){

            return response(["error" => "Max persons in this room are ".$room->max_persons],422);
        }



        $servicePrice = 0;
        foreach ($room->service as $s){
            $servicePrice += $s->pivot->price;
        }

        $totalPrice = $servicePrice+$room->price;

        $room->available_rooms -= 1;

        $reservation = new Reservation();
        $reservation->user_id = $request->input("userId");
        $reservation->room_id = $request->input("roomId");
        $reservation->check_in = $check_in;
        $reservation->check_out = $check_out;
        $reservation->adults = $request->input("adults");
        $reservation->children = $request->input("children");
        $reservation->total_price = $totalPrice;

        try{
            $reservation->save();
            $room->save();
            $this->log("User successfully made reservation for room with id ".$room->id,$request);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on reservating room with id ".$room->id,$request);
            return response(["error" => "Server error, try again later"],500);
        }



    }

    public function insertRating(Request $request){

        if(!session()->has("user")){
            return response(["error" => "You need to be registered to make a vote!"],401);
        }

        $alreadyVoted = Vote::where([
            ["user_id","=",$request->input("userId")],
            ["room_id","=",$request->input("roomId")]
        ])->first();

        if($alreadyVoted){
            return response(["error" => "You can only vote once, you have already voted for this room!"],422);
        }

        $vote = new Vote();
        $vote->vote = $request->input("rating");
        $vote->user_id = $request->input("userId");
        $vote->room_id = $request->input("roomId");

        $voteInsert = $vote->save();

        if($voteInsert){
            return response("",204);
        }else{
            return response(["error" => "Server error, try again later!"],500);
        }
    }

    public function insertCommnet(Request $request){
        $text = $request->input("text");
        if(!$text){
            return response(["error" => "Comment filed cant be empty!"],422);
        }
        $comment = new Comment();
        $comment->text = $text;
        $comment->user_id = $request->input("userId");
        $comment->commentable_type = "App\Models\Room";
        $comment->commentable_id = $request->input("roomId");

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
            $this->log("Admin successfully deleted comment with id ".$comment->id,$request);
            $comment->delete();
            return response("",204);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin deleteing comment with id ".$comment->id,$request);
            return response("",500);
        }
    }



}
