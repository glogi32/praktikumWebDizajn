<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = "services";

    public function rooms(){
        return $this->belongsToMany(Room::class,"room_service")->withPivot("price","service_id")->withTimestamps();
    }

}
