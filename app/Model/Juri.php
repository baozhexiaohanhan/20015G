<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Juri extends Model
{
    protected $table="ad";
    protected $primaryKey="ad_id";
    public $timestamps=false;
    protected $guarded=[];
}
