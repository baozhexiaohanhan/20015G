<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    		protected $table = 'admin';
		    protected $guarded = []; 
		    protected $primaryKey = "admin_id";
			  
			public $timestamps = false;
}
