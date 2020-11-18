<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $guarded = [];
    protected $primaryKey = "user_id";

    // protected $fillable = ['role_name','role_desc'];
    
    public $timestamps = false;
}
