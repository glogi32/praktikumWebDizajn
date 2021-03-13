<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = [
            ["name" => "Home","url" => "/home","order" => 1],
            ["name" => "Rooms","url" => "/rooms","order" => 2],
            ["name" => "About us","url" => "/about-us","order" => 3],
            ["name" => "Blog","url" => "/blog","order" => 4],
            ["name" => "Contact","url" => "/contact","order" => 5]
        ];

        foreach ($menu as $m){
            $menuTable = new Menu();

            $menuTable->name = $m["name"];
            $menuTable->url = $m["url"];
            $menuTable->order = $m["order"];

            $menuTable->save();
        }
    }
}
