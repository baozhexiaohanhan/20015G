<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Goods_log;
use App\Model\Attr;
use App\Model\Goods_attr;
class DetailsController extends Controller
{
    public function details($goods_id=0){
        $goods_id = 2;
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
        //     $newinfo = [];
        // foreach($data2 as $k=>$v){
        //     $newinfo[$v['attr_id']]['attr_name'] = $v['attr_name'];
        //     $newinfo[$v['attr_id']]['attr_value'][$v['goods_attr_id']] = $v['attr_value'];
        // }
        // dd($newinfo);

        $shop = [
            "goods"=>$goods,
            "goods_log"=>$Goods_log,
            "attrs_new_key"=>$attrs_new_key,
            "newinfo"=>$newinfo,
        ];
        $shop = json_encode($shop);
        $shop = ["ok","data"=>$shop];
        // dd($shop);
        return $shop; 
    }
    public function attr_key(){
    //     $cal = request()->callback;
    //     $callback = "2";
    //     // $callback = request()->get("goods_id");
    //     // $data = 1;
    //     $result = json_encode(['code'=>1,'msg'=>'ok','data'=>$callback]);
    // echo $callback.'('.$result.')';
    //     // dd($data);
        // echo $result;
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
}
