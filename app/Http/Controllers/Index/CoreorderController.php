<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
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
    public function tucu(Request $request){
		Redis::del("admin");
        $request->session()->forget('name');
		return redirect("/");
	}
	public function udai_collect()
    {
        $url = "http://www.2001api.com/udai_collect";
        $data = curl_get($url);
//        dd($data);
        $data = json_decode($data['data'],true);
//         dd($data);
        return view("index.coreorder.udai_collect",['data'=>$data]);
    }
}
