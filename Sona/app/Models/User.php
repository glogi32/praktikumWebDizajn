<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "users";

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function image(){
        return $this->morphOne(Image::class,"imageable");
    }

    public function reservation(){
        return $this->belongsToMany(Room::class,"reservations")->withPivot("check_in","check_out","adults","children","total_price","id","deleted_at")
            ->whereNull('reservations.deleted_at')->withTimestamps();
    }

    public function vote(){
        return $this->hasMany(Vote::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function post(){
        return $this->hasMany(Post::class);
    }
}
