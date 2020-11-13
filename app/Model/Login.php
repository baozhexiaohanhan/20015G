<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    		protected $table = 'admin';
		    protected $guarded = []; 
		    protected $primaryKey = "admin_id";
			  
			    // protected $fillable = ['cat_name','enabled','attr_group'];
			public $timestamps = false;
			//
}
