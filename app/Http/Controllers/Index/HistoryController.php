<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\History;
use App\Model\Goods;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;

class HistoryController extends Controller
{
    public function history(){
        $user_id=Redis::hmget("admin",["user_id"]);
        $user_id=implode("",$user_id);
        $history=Cookie::get('historyInfo');
        $history=unserialize($history);
        // dd($history);
        if($history){
            // echo 123;die;
            // dd(1);
            $goods_id=array_column($history,'goods_id');
            $goods=Goods::whereIn('goods_id',$goods_id)->get();
            // dd($goods); 
        }

        //浏览历史记录
        $urls = "http://www.2001api.com/historys";
        $history = curl_get($urls);
        $history = json_decode($history['data'],true);

        // dd($history);
        if($user_id){
            return view('index.coreorder.history',['history'=>$history]);
               
        }else{
            return view('index.coreorder.history',['history'=>$goods]);

        }
        // $history['goods']=$goods;
        // dd($history);
    }

    
}



