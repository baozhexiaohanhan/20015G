<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    protected $table = 'right';
    protected $guarded = [];
    protected $primaryKey = "right_id";
    public $timestamps = false;
}
