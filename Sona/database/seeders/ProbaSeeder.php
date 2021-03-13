<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProbaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker =  Faker::create();
        foreach(range(1,15000) as $i){
            $id = \DB::table("comments")->insert([
                "text" => $faker->text(),
                "user_id" => $faker->numberBetween(1, 75),
                "room_id" => $faker->numberBetween(1, 75),
                "created_at" => date("Y-m-d H:i:s", time())
            ]);
        }
    }
}
