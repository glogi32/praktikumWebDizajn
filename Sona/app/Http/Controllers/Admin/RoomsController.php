<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\RoomService;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Requests\RoomRequest;
use App\Models\Room;
use Illuminate\Support\Facades\DB;

class RoomsController extends FrontAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        foreach ($rooms as $r){
            $r->urlEdit = route("rooms.edit",$r->id);
        }
        $this->data["rooms"] = $rooms;
        return view("admin.pages.rooms",$this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data["form"] = "add";
        $this->data["services"] = Service::all();


        return view("admin.pages.rooms",$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoomRequest $request)
    {
        $room = new Room();


        $room->name = $request->input("name");
        $room->size = $request->input("size");
        $room->max_persons = $request->input("maxPersons");
        $room->beds = $request->input("beds");
        $room->price = $request->input("price");
        $room->description = $request->input("description");
        $room->available_rooms = $request->input("availableRooms");
        $room->service_price_percentage = (float)$request->input("pricePercentage");


        $selectedServices = $request->input("services");



        DB::beginTransaction();
        $image = $request->file("roomImage");
        $image_name = time()."_".$image->getClientOriginalName();
        $directory = \public_path()."/img/rooms";
        $path = "img/rooms/".$image_name;

        try{

            $uploadImage = $image->move($directory,$image_name);

            $insertRoom = $room->save();
            $roomId = $room->id;

            $imageModel = new Image();
            $imageModel->alt = $image_name;
            $imageModel->src = $path;
            $imageModel->imageable_id = $roomId;
            $imageModel->imageable_type = "App\Models\Room";

            $insertRoomImage = $imageModel->save();

            if($selectedServices){

                foreach ($selectedServices as $s){
                    $serviceId = explode("-",$s)[0];
                    $servicePrice = explode("-",$s)[1];
                    $price = (float)$request->input("pricePercentage") * $servicePrice;

                    $room_service = new RoomService();
                    $room_service->room_id = $roomId;
                    $room_service->service_id = $serviceId;
                    $room_service->price = $price;

                    $insertRoomService = $room_service->save();
                }

            }

        }catch (\Exception $e){
            \Log::error($e->getMessage());

            $this->deleteImage($path);
            $this->log("Error on admin adding room",$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertRoomError" , "Server error on adding room, try again later.")->withInput();
        }

        if($insertRoom && $insertRoomImage){
            DB::commit();
            $this->log("Admin successfully added room with id ".$room->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertRoomSuccess","Room successfully added!");
        }else{

            DB::rollBack();

            $this->deleteImage($path);
            $this->log("Error on admin adding room",$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("insertRoomError" , "Server error on adding room, try again later.")->withInput();
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
        $room = Room::with("service")->where("id",$id)->first();
        $roomServicesId = [];
        foreach ($room->service as $s){
            array_push($roomServicesId,$s->id);
        }
        $room->roomServiceId = $roomServicesId;


        $this->data["services"] = Service::all();
        $this->data["form"] = "edit";
        $this->data["room"] = $room;
        return view("admin.pages.rooms",$this->data);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoomRequest $request, $id)
    {
        $room = Room::with("image")->where("id",$id)->first();


        $room->name = $request->input("name");
        $room->size = $request->input("size");
        $room->max_persons = $request->input("maxPersons");
        $room->beds = $request->input("beds");
        $room->price = $request->input("price");
        $room->description = $request->input("description");
        $room->available_rooms = $request->input("availableRooms");
        $room->service_price_percentage = (float)$request->input("pricePercentage");


        $selectedServices = $request->input("services");



        DB::beginTransaction();
        $image = $request->file("roomImage");
        $image_name = time()."_".$image->getClientOriginalName();
        $directory = \public_path()."/img/rooms";
        $path = "img/rooms/".$image_name;

        try{

            $uploadImage = $image->move($directory,$image_name);



            $updateRoom = $room->save();
            $roomId = $room->id;

            $imageModel = Image::find($room->image->id);
            $this->deleteImage($imageModel->src);

            $imageModel->alt = $image_name;
            $imageModel->src = $path;
            $imageModel->imageable_id = $roomId;
            $imageModel->imageable_type = "App\Models\Room";

            $updateRoomImage = $imageModel->save();

            $deleteRoomServices = RoomService::where("room_id",$id)->delete();

            if($selectedServices && $deleteRoomServices){

                foreach ($selectedServices as $s){
                    $serviceId = explode("-",$s)[0];
                    $servicePrice = explode("-",$s)[1];
                    $price = (float)$request->input("pricePercentage") * $servicePrice;

                    $room_service = new RoomService();
                    $room_service->room_id = $roomId;
                    $room_service->service_id = $serviceId;
                    $room_service->price = $price;

                    $insertRoomServices = $room_service->save();
                }

            }

        }catch (\Exception $e){
            \Log::error($e->getMessage());

            $this->deleteImage($path);
            $this->log("Error on admin updating room with id ".$room->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("updateRoomError" , "Server error on updating room, try again later.")->withInput();
        }

        if($updateRoom && $updateRoomImage && $uploadImage){
            DB::commit();
            $this->log("Admin successfully updated room with id ".$room->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("updateRoomSuccess","Room successfully updated!");
        }else{

            DB::rollBack();

            $this->deleteImage($path);
            $this->log("Error on admin updating room with id ".$room->id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return redirect()->back()->with("updateRoomError" , "Server error on updating room, try again later.")->withInput();
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
            $room = Room::find($id);
            if(!$room){
                return response("",404);
            }
            $room->delete();
            $this->log("Admin successfully deleted room with id ".$id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return response("",204);
        }catch (\Exception $e){
            \Log::error($e->getMessage());
            $this->log("Error on admin deleting room with id ".$id,$request->url(),$request->method(),$request->ip(),$request->userAgent(),session("user")->id);
            return response("",500);
        }
    }
}
