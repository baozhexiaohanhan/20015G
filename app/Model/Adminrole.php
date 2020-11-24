<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Adminrole extends Model
{
    protected $table = 'admin_role';
    protected $guarded = [];
    protected $primaryKey = "admin_role_id";
    public $timestamps = false;
}
