<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Seckill;
use Illuminate\Support\Facades\Redis;
class SeckillController extends Controller
{
    public function seckill(){
        $goods = Goods::get();
        return view("admin.seckill.seckill",compact("goods"));
    }
    public function seckill_add(){
        $da = request()->except("_token");
        // $da = request()->except("_token");
        // dd($da);
        // $goods_id = 4;
        $goods_price = Goods::select("goods_price")->where("goods_id",$da['goods_id'])->first();
        $goods_price = substr($goods_price['goods_price'],0,3);
        
        $data = [
            "name" => $da['name'],
            "start_time" => strtotime($da['start_time']),
            "end_time" => strtotime($da['end_time']),
            "is_close" => $da['is_close'],
            "goods_id" => $da['goods_id'],
            "yuan" => $goods_price,
            "price" => $da['price'],
            "intro" => $da['intro'],
            "number" => $da['number'],
        ];
        
        $goods_id = $da['goods_id'];
       $res = Seckill::insert($data);
        // dd($res);
        // $buy_number = Goods::where("goods_id",$goods_id)->value("goods_store");
        $buy_number = $da['number'];
        $key = "goods_".$goods_id;
        // dd($key);
        for ($i=0; $i < $buy_number; $i++) { 
            Redis::lpush($key,1);
        }
        

        // if($res){
            return redirect("/seckill_index");
        // dd($da);
    }
    public function seckill_index(){
        $seckill = Seckill::where("seckill.is_del",1)->leftjoin("goods","seckill.goods_id","=","goods.goods_id")->get();
        return view("admin.seckill.seckill_index",compact("seckill"));
    }
    public function updates($id){
        $goods = Goods::get();
        $res = Seckill::find($id);
        // return $res;
        return view("admin.seckill.updates",compact("goods","res"));
    }
    public function del(){
        $res = request()->cat_id;
        $res = Seckill::where("id",$res)->update(['is_del'=>2]);
       return json_encode(["code"=>001,"msg"=>"成功"]);
    }
    public function seckill_jia(){
        $goods_id = request()->goods_id;
        $goods_price = Goods::select("goods_price","goods_number")->where("goods_id",$goods_id)->first();
        // dd($goods_price);
        return $mssage = [
            "code"=>001,
            "msg"=>"cg",
            "data"=>$goods_price['goods_price'],
            "number"=>$goods_price['goods_number'],
        ];
    }
}
