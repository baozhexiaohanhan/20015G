<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    		protected $table = 'notice';
		    protected $guarded = []; 
		    protected $primaryKey = "notice_id";
			  
			public $timestamps = false;
}
