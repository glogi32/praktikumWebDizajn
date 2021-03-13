<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ["first_name" => "Admin","last_name" => "Admin","email"=> "admin@gmail.com","password" => "admin","phone" => "065448466","role_id" => "1"],
            ["first_name" => "Admin1","last_name" => "Admin1","email"=> "admin1@gmail.com","password" => "admin1","phone" => "065444466","role_id" => "1"],
            ["first_name" => "User","last_name" => "User","email"=> "user@gmail.com","password" => "user","phone" => "0654465465","role_id" => "2"]
            ];

        foreach($users as $u){

            $user = new User();

            $user->first_name = $u["first_name"];
            $user->last_name = $u["last_name"];
            $user->password = md5($u["password"]);
            $user->email = $u["email"];
            $user->phone = $u["phone"];
            $user->role_id = $u["role_id"];

            $user->save();
        }
    }
}
