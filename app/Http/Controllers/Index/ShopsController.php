<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class ShopsController extends Controller
{
    public function shops(){
        $seller_id = request()->seller_id;
        // dd($seller_id);
    	$url = "http://www.2001api.com/shops/shops?seller_id=".$seller_id;
        // dd($url);
        $msg = curl_get($url);
        // dd($msg);

        $msg = json_decode($msg['data'],true);
        // dd($msg);
        return view('index.shops.shops',['msg'=>$msg]);
    }
}
