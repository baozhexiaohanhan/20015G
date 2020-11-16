<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role_juri extends Model
{
    protected $table = 'role_right';
    protected $guarded = [];
    protected $primaryKey = "role_right_id";
    public $timestamps = false;
}
