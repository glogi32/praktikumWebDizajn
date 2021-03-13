<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            ["name" => "Wifi and cable tv","price" => 0],
            ["name" => "Television","price" => 4],
            ["name" => "Direct telephone line","price" => 0],
            ["name" => "Personal safe","price" => 7],
            ["name" => "Laundry and ironing services","price" => 10],
            ["name" => "Dry cleaning services","price" => 15],
            ["name" => "Mini bar","price" => 7],
            ["name" => "Hair dryer","price" => 5],
            ["name" => "Bathrobe and slippers","price" => 3],
            ["name" => "Tea and coffee set","price" => 4],
        ];

        foreach ($services as $s){
            $serviceModel = new Service();
            $serviceModel->name = $s["name"];
            $serviceModel->price = $s["price"];
            $serviceModel->save();
        }
    }
}
