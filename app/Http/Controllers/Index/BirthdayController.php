<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Birthday;
class BirthdayController extends Controller
{
    public function page(){


  	$birthday_id = 1;
    $data = Birthday::where('birthday_id',$birthday_id)->first();
   

    	return view('index.page.page',['data'=>$data]);
    }
}
