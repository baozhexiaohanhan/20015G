<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $table = 'region';
    protected $guarded = [];
    protected $primaryKey = "region_id";
    public $timestamps = false;
}
