<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = ["room-1.jpg","room-2.jpg","room-3.jpg","room-4.jpg","room-5.jpg","room-6.jpg","room-7.jpg"];


        $faker = Faker::create();

        foreach (Range(1,15) as $r){
            $room = new Room();
            $room->name = $faker->name;
            $room->size = $faker->numberBetween(30,250);
            $room->max_persons = $faker->numberBetween(1,10);
            $room->beds = $faker->numberBetween(1,10);
            $room->price = $faker->numberBetween(69,700);
            $room->description = $faker->paragraph(6);
            $room->available_rooms = $faker->numberBetween(0,10);

            $room->save();

            $id = $room->id;

            $imageModel = new Image();
            $image = $images[array_rand($images)];

            $imageModel->alt = $image;
            $imageModel->src = "img/rooms/".$image;
            $imageModel->imageable_id = $id;
            $imageModel->imageable_type = "rooms";
            $imageModel->save();


        }

    }
}
