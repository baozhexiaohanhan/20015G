<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoreorderController extends Controller
{
    public function welcome(){
        return view("index.coreorder.welcome");
    }
    public function udai_order(){
        $url = "http://www.2001api.com/udai_order";
        $data = curl_get($url);
        $data = json_decode($data['data'],true);
        // dump($data);
        return view("index.coreorder.udai_order",compact("data"));
    }
}