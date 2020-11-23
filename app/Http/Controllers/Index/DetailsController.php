<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Helpers\Cull;
class DetailsController extends Controller
{
    public function details(){
        $goods_id = request()->post("goods_id");
        // dd($goods_id);
        $url ="http://www.2001api.com/details?goods_id=".$goods_id;
   
      
        $data = curl_get($url);
        // dd($data);
        $data = json_decode($data['data'],true);
        // dump($data);
        return view("index.details.details",compact('data'));
    }
}
