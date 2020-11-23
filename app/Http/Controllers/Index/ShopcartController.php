<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopcartController extends Controller
{
    public function shopcart(Request $request){
        $rec_id = $request->rec_id;
        dd($rec_id);
        return view('index/shopcart/shopcart');
    }
}
