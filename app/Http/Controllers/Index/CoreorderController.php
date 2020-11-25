<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreorderController extends Controller
{
    public function welcome(){
        return view("index.coreorder.welcome");
    }
}
