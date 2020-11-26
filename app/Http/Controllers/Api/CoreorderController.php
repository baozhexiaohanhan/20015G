<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order_info;
use App\Model\Order_goods;
class CoreorderController extends Controller
{
    public function udai_order(){
        // $user = request()->session()->get("name");
        // if($user==""){
            // return redirect("/user/login");
        // }
        $user_id = 2;
        $order_info = Order_info::where(["user_id"=>$user_id,"is_del"=>0])->get();
        foreach($order_info as $k=>$v){
            $data = Order_goods::where("order_id",$v['order_id'])->leftjoin("goods","order_goods.goods_id","=","goods.goods_id")->get();
            $v['goods_data'] = $data;
        }
        $order_info = json_encode($order_info);
        $shop = ["ok","data"=>$order_info];
        return $shop;
    }
    public function udai_shopcart_pay(){
        $callback = request()->callback;
        $order_id = request()->get("order_id");
        $res = Order_info::where("order_id",$order_id)->update(['pay_status'=>3,'order_status'=>2]);
        if($res){
            $result = json_encode(['code'=>1001,'msg'=>'ok']);
            echo $callback.'('.$result.')';
        }
    }
}
