<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Pivot
{
    use HasFactory;
    use SoftDeletes;

    public $incrementing = true;
    protected $table = "reservations";


}
