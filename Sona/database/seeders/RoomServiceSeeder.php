<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomService;
use App\Models\Service;
use Illuminate\Database\Seeder;

class RoomServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rooms = Room::all();
        foreach ($rooms as $r){

            $range = range(1,10);
            shuffle($range);
            $n = rand(3,5);
            $result = array_slice($range,0,$n+1);

            foreach (range(0,$n-1) as $i){

                $service = Service::find($result[$i]);

                $price = $r->service_price_percentage * $service->price;

                $room_service = new RoomService();
                $room_service->room_id = $r->id;
                $room_service->service_id = $result[$i];
                $room_service->price = $price;
                $room_service->save();
            }







        }
    }
}
