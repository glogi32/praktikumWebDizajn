<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    protected $table = "topics";

    public function topic(){
        return $this->belongsToMany(Post::class,"post_topic")->withPivot("created_at")->withTimestamps();
    }
}
