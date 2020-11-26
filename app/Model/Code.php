<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    		protected $table = 'code';
		    protected $guarded = []; 
		    protected $primaryKey = "code_id";
			  
			public $timestamps = false;
}
