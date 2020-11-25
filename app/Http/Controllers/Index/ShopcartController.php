<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopcartController extends Controller
{
    public function shopcart(Request $request){
        $rec_id = request()->post("rec_id");
        // dd($rec_id);

        $url = "http://www.2001api.com/shop/shopcart?rec_id=".$rec_id;

        $data = curl_get($url);
        // dd($data);
        $data = json_decode($data['msg'],true);
        // dd($data); 

        return view('index/shopcart/shopcart',compact('data'));
    }
}
