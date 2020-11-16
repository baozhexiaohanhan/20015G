<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class roleright extends Model
{
    protected $table = 'role_right';
    protected $guarded = [];
    protected $primaryKey = "role_right_id";
    public $timestamps = false;
}
