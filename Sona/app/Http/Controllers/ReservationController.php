<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReservationController extends FrontController
{
    public function index(){

        if(session()->has("user")){
            $this->data["user"] = User::with("reservation")->where("id",session("user")->id)->first();
        }else{
            $this->data["user"] = null;
        }


        return view("pages.reservations",$this->data);
    }

    public function getAllReservations(Request $request){

        $userId = $request->input("userId");

        $userReservations = User::with("reservation")->where("id",$userId)->first();

        foreach ($userReservations->reservation as $r){
            $r->formatedCheckIn = date("d:m:Y",strtotime($r->pivot->check_in));
            $r->formatedCheckOut = date("d:m:Y",strtotime($r->pivot->check_out));
            $r->formatedCreated = date("d:m:Y",strtotime($r->pivot->created_at));
        }

        return $userReservations;
    }

    public function cancelReservation($id){

        try{
            $reservation = Reservation::find($id);

            if(!$reservation){
                return response("",404);
            }

            $room = Room::find($reservation->room_id);
            $room->available_rooms++;
            $room->save();
            $reservation->delete();

            return response("",204);

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return response("",500);
        }
    }
}
