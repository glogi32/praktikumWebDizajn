<?php


namespace App\Models;


class RoleModel
{
    private $table = "roles";

    public function getAll(){
        return \DB::table($this->table)
            ->get();
    }

}
