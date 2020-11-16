<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PositionModel extends Model
{
    protected $table="ad_position";
    protected $primaryKey="position_id";
    public $timestamps=false;
    protected $guarded=[];
}
