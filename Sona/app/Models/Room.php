<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "rooms";

    public function image(){
        return $this->morphOne(Image::class,"imageable");
    }

    public function service(){
        return $this->belongsToMany(Service::class,"room_service")->withPivot("price","service_id")->withTimestamps();
    }

    public function reservation(){
        return $this->belongsToMany(User::class,"reservations")->withPivot("check_in","check_out","adults","children","total_price","id","deleted_at")
            ->whereNull('reservations.deleted_at')->withTimestamps();
    }

    public function vote(){
        return $this->hasMany(Vote::class);
    }

    public function comment(){
        return $this->morphMany(Comment::class,"commentable");
    }


}
