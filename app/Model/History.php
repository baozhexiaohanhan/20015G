<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table="history";
    protected $primaryKey="hid";
    public $timestamps=false;
    protected $guarded=[];
}
