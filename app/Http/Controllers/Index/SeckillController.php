<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeckillController extends Controller
{
    public function seckill(){
        $url = "http://www.2001api.com/seckill";
        $info = curl_get($url);
        // dd($info);
        $res = json_decode($info['data'],true);
        // dd($res);
        return view("index.seckill.seckill",compact("res"));
    }
    public function miaosha_shows(){
        $url = "http://www.2001api.com/miaosha_show?goods_id=".$goods_id."&seckill_id=".$seckill_id;

        $info = curl_get($url);
       
        // $goods_id = $info['goods_id'];
        // $goods_id2 = implode(" ",$goods_id);
        // trim($goods_id);
        // dd($info);
        if($info['goods_id']){
            $goods_id = json_decode($info['goods_id'],true);
            return redirect('/details/?goods_id='.$goods_id);
        }
      
    }
    public function miaosha_show(){
        $goods_id = request()->post("goods_id");
        $seckill_id = request()->post("seckill_id");
        // dd($seckill_id);
        $url = "http://www.2001api.com/miaosha_show?goods_id=".$goods_id."&seckill_id=".$seckill_id;

        $info = curl_get($url);
    //    1.秒杀结束后跳转到普通商品  2。未结束继续执行秒杀
        if(isset($info['goods_id'])){
            $goods_id = json_decode($info['goods_id'],true);
            return redirect('/details/?goods_id='.$goods_id);
        }
        if(isset($info['data'])){
            $data = json_decode($info['data'],true);
        }
    //    dd($data);
      
        return view("index.seckill.miaosha_show",compact("data"));
    }
   
    public function miaosha_show_add(){
        $goods_id = request()->goods_id;
        $goods_attr_id = request()->goods_attr_id;
        // $url = "http://www.2001api.com/miaosha_show_add?goods_id=".$goods_id."&goods_attr_id=".$goods_attr_id;
        // $info = curl_get($url);
        // dd($a);
        dd($info);
    }
}
