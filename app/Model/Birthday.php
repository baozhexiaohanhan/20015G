<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Birthday extends Model
{
    
    		protected $table = 'birthday';
		    protected $guarded = []; 
		    protected $primaryKey = "birthday_id";
			  
			public $timestamps = false;
}
