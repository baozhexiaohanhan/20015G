<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopcartController extends Controller
{
    public function shopcart(){
        return view('index/shopcart/shopcart');
    }
}
