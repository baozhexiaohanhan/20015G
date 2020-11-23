<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeckillController extends Controller
{
    public function seckill(){
        $url = "http://www.2001api.com/seckill";
        $info = curl_get($url);
        $res = json_decode($info['data'],true);
        dump($res);
        return view("index.seckill.seckill",compact("res"));
    }
}
