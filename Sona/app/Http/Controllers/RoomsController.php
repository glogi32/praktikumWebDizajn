<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Service;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RoomsController extends FrontController
{
    public function index()
    {

        $this->data["services"] = Service::all();
        return view("pages.rooms",$this->data);
    }

    public function filterRooms(Request $request){
        $searchText = $request->input("searchText");
        $beds = explode("-",$request->input("beds"));
        $maxPersons =  explode("-",$request->input("maxPersons"));
        $minSize = $request->input("minSize");
        $maxSize = $request->input("maxSize");
        $minPrice = $request->input("minPrice");
        $maxPrice = $request->input("maxPrice");

        $servicesArray = $request->input("services");


        $query = Room::with("image","service");



        if($searchText){
            $query->where("name","like","%".$searchText."%");
        }
        if(intval($beds[0])){
            $query->whereBetween("beds",[intval($beds[0]),intval($beds[1])]);
        }
        if(intval($maxPersons[0])){
            $query->whereBetween("max_persons",[intval($maxPersons[0]),intval($maxPersons[1])]);
        }
        if($minSize){
            $query->whereBetween("size",[$minSize,$maxSize]);
        }
        if($minPrice){
            $query->whereBetween("price",[$minPrice,$maxPrice]);
        }


        if($servicesArray){
            foreach ($servicesArray as $s){
                $query->whereHas("service", function (Builder $q) use($s){
                    $q->where("services.id",$s);
                });
            }
        }


        return $query->paginate(4);

    }


}
