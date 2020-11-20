<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function details(){
        $url = "http://www.2001api.com/details";
        $data = curl_get($url);
        // dd($data);
        $data = json_decode($data['data'],true);
        dump($data);
        return view("index.details.details",compact('data'));
    }
}
