<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "posts";

    public function comments(){
        return $this->morphMany(Comment::class,"commentable");
    }

    public function user(){
       return $this->belongsTo(User::class);
    }

    public function topic(){
        return $this->belongsToMany(Topic::class,"post_topic")->withPivot("created_at")->withTimestamps();
    }

    public function image(){
        return $this->morphOne(Image::class,"imageable");
    }

    public function comment(){
        return $this->morphMany(Comment::class,"commentable");
    }

}
