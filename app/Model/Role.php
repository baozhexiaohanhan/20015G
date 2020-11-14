<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
<<<<<<< HEAD
    protected $table = "role";
    protected $guarded = [];
    protected $primarykey = "role_id";
    public $timestamps = false;
=======
    protected $table = 'role';
    // protected $guarded = [];
    protected $primaryKey = "role_id";

    protected $fillable = ['role_name','role_desc'];
    public $timestamps = false;

>>>>>>> 656be9db0768e25f5d56c43b1b31209605273162
}
