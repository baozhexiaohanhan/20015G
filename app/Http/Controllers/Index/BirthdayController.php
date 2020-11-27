<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Birthday;
class BirthdayController extends Controller
{
    public function page(){


    	return view('index.page.page');
    }
}
