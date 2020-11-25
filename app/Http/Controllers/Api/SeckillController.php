<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Seckill;
use App\Model\Goods_log;
use App\Model\Attr;
use App\Model\Goods_attr;
use Illuminate\Support\Facades\Redis;
class SeckillController extends Controller
{
    public function seckill(){
        $info = Seckill::leftjoin("goods","seckill.goods_id","=","goods.goods_id")->where(['seckill.is_del'=>1,"goods.is_up"=>1])->get();
        $info = json_encode($info);
        $data = ["ok","data"=>$info];
        // dd($data);
        return $data;
    }
    public function miaosha_show(){
        $goods_id = request()->goods_id;
        $seckill_id = request()->seckill_id;
        $where = [
            ["id","=",$seckill_id],
            ["end_time",">",strtotime(date("Y-m-d H:i:s",time()))],
            ['is_close',"=",1]
        ]; 
        $sec = Seckill::where($where)->first();
        if($sec){
        // dd($goods_id);
        $seckill = Seckill::where("id",$seckill_id)->first();
        $goods = Goods::where("goods_id",$goods_id)->first();
        $Goods_log = Goods_log::where("goods_id",$goods_id)->first();

        $data = Goods_attr::select("goods_attr_id","goods_attr.attr_id","attr.attr_name","goods_attr.attr_value")->leftjoin("attr","goods_attr.attr_id","=","attr.attr_id")->where(['goods_id'=>$goods_id,"attr_type"=>1])->get();
        $newinfo = Goods_attr::select("goods_attr_id","goods_attr.attr_id","attr.attr_name","goods_attr.attr_value")->leftjoin("attr","goods_attr.attr_id","=","attr.attr_id")->where(['goods_id'=>$goods_id,"attr_type"=>0])->get();
        $attrs_new_key = [];
        foreach($data as $k=>$v){
            $attrs_new_key[$v['attr_id']]['attr_name'] = $v['attr_name'];
            $attrs_new_key[$v['attr_id']]['attr_value'][$v['goods_attr_id']] = $v['attr_value'];
        }
        $hits = Redis::zincrby("hits",1,"hits_".$goods_id);
        
        $shop = [
            "goods"=>$goods,
            "goods_log"=>$Goods_log,
            "attrs_new_key"=>$attrs_new_key,
            "newinfo"=>$newinfo,
            "seckill"=>$seckill,
            "hits"=>$hits
        ];
        
        $shop = json_encode($shop);
        $shop = ["ok","data"=>$shop];

        return $shop;
        } 
        $goods_id = json_encode($goods_id);
        $goods_id = ["ok","goods_id"=>$goods_id];

        return $goods_id;
    }
    public function miaosha_show_add(){
        $callback = request()->callback;

        $goods_id = request()->get("goods_id");
        $goods_attr_id = request()->get("goods_attr_id");
        $seckill_id = request()->get("seckill_id");
        $user_id = 2;
        // Redis::del("goods_user_".$goods_id,$user_id);
        $where = [
            ["id","=",$seckill_id],
            ["end_time",">",strtotime(date("Y-m-d H:i:s",time()))],
            ['is_close',"=",1]
        ]; 
        $sec = Seckill::where($where)->first();
        if($sec==null){
            $result = json_encode(['code'=>1002,'msg'=>'秒杀已结束']);
            return $callback.'('.$result.')';die;
        }
        if(Redis::sismember("goods_user_".$goods_id,$user_id)){
            $result = json_encode(['code'=>1001,'msg'=>'您已抢购过']);
            return $callback.'('.$result.')';die;
        }
        $key = "goods_".$goods_id;
        if(!Redis::rpop($key)){
            return "商品已抢购完";
        }
        Redis::sadd("goods_user_".$goods_id,$user_id);
        // dd($goods_attr_id);
        // $data = Brand::all();
        
        // $a = Redis::llen($key);



        $result = json_encode(['code'=>1110,'msg'=>'ok']);
        return $callback.'('.$result.')';
    }
    // 秒杀商品价格
    public function attr_keys(){
        $callback = request()->callback;
        // $data = Brand::all();
        $goods_id = request()->get("goods_id");
        $goods_attr_id = request()->get("goods_attr_id");
        $seckill_id = request()->get("seckill_id");
        // dd($seckill_id);
        $data = request()->all();
        $attr_price = Goods_attr::whereIn("goods_attr_id",$goods_attr_id)->sum("attr_price");
        // $goods_price = Goods::where("goods_id",$goods_id)->first();
        $price = Seckill::where("id",$seckill_id)->first();

        $attr_goods = $price['price']+$attr_price;
        $attr_goods = number_format($attr_goods,2,".","");



        $result = json_encode(['code'=>1,'msg'=>'ok','data'=>$attr_goods]);
        echo $callback.'('.$result.')';
    }
}
