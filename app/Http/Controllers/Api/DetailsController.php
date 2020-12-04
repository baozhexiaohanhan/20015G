<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Goods_log;
use App\Model\Attr;
use App\Model\Goods_attr;
use App\Model\History;
use Illuminate\Support\Facades\Redis;
use DB;
class DetailsController extends Controller
{
    public function details(){
        $goods_id = request()->goods_id;
        // dd($goods_id);
        $user_id=Redis::hmget("admin",["user_id"]);
        $user_id=implode("",$user_id);
//         dd($user_id);
        if($user_id){
        // dd($user_id);
        //查看用户是否浏览过该商品
        $history=History::where(['user_id'=>$user_id,'goods_id'=>$goods_id])->get();
        // return $history;
        if(count($history)>0){
            //用户浏览过的商品 时间改为当前时间
            History::where(['user_id'=>$user_id,'goods_id'=>$goods_id])->update(['look_time'=>time()]);
            // dd($res);
        }else{
            //用户没有浏览过商品 添加入库
            History::insert(['look_time'=>time(),'user_id'=>$user_id,'goods_id'=>$goods_id]);
            // dd($History);
        }
        }
//        统计点击量
//        $hits = Redis::setnx('hit_'.$goods_id,1)?:Redis::incr('hit_'.$goods_id,1);
        $hits =Redis::zincrby('hit',1,'hit_'.$goods_id);
//        dd($hits);
//        取点击量最高的五条
        $hitgoods = Redis::zrevrange('hit',0,4);
//        dd($hitgoods);
        if($hitgoods){
            $hit_goods_id = [];
            foreach ($hitgoods as $v){
                $hitsarr = explode('_',$v);
                $hit_goods_id[] = $hitsarr[1];
            }
//            dd($hit_goods_id);
            $hot_goods = DB::table('goods')->whereIn('goods_id',$hit_goods_id)->get();
        }
//        dd($hot_goods);
        $coupon = DB::table('coupon')->where(['range'=>$goods_id])->get()->toArray();
//        dd($coupon);
        $goods = Goods::where("goods_id",$goods_id)->first();

        $Goods_log = Goods_log::where("goods_id",$goods_id)->first();

        $data = Goods_attr::select("goods_attr_id","goods_attr.attr_id","attr.attr_name","goods_attr.attr_value")->leftjoin("attr","goods_attr.attr_id","=","attr.attr_id")->where(['goods_id'=>$goods_id,"attr_type"=>1])->get();
        // dump();
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
            "hits"=>$hits,
            "hot_goods"=>$hot_goods,
            "coupon"=>$coupon
        ];
        $shop = json_encode($shop);
        $shop = ["ok","data"=>$shop];
        // dd($shop);
        return $shop; 
    }
    public function attr_key(){
   
        $callback = request()->callback;
        // $data = Brand::all();
        $goods_id = request()->get("goods_id");
        $goods_attr_id = request()->get("goods_attr_id");

        $data = request()->all();
        $attr_price = Goods_attr::whereIn("goods_attr_id",$goods_attr_id)->sum("attr_price");
        $goods_price = Goods::where("goods_id",$goods_id)->first();

        $attr_goods = $goods_price['goods_price']+$attr_price;
        $attr_goods = number_format($attr_goods,2,".","");



        $result = json_encode(['code'=>1,'msg'=>'ok','data'=>$attr_goods]);
        echo $callback.'('.$result.')';
    }

    // public function history(){
    //     $user_id=Redis::hmget("admin",["user_id"]);
    //     $user_id=implode("",$user_id);
    //     // dd($user_id);
    //     //根据用户id 获取修改用户浏览的商品 根据时间倒序 获取前几条
    //     $history=History::leftjoin('goods','goods.goods_id','=','history.goods_id')
    //             ->where('user_id',$user_id)->orderBy('history.look_time','desc')->limit(10)->get();
    //             // dd($history);
    //     // if(count($history)>0){
    //     //     //查到获取浏览信息
    //     //     $history=['ret'=>$history];
    //     //     // dd($history);
    //     // }else{
    //     //     $history=['ret'=>[]];
    //     //     // dd($history);
    //     // }
    //     // return json_encode($history);
    //     $history=[
    //         'user_id'=>$user_id,
    //         'history'=>$history
    //     ];
    //     $history = json_encode($history);
    //     $history = ["ok","data"=>$history];
    //     return $history;
    // }


}
