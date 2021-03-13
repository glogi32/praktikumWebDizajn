<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = ["event","travel trip","camping","hotels","holidays","food","lifestyle"];

        foreach ($topics as $t){
            $topic = new Topic();
            $topic->name = $t;
            $topic->save();
        }
    }
}
