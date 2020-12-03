<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use DB;
use Illuminate\Support\Facades\Redis;
class CouponController extends Controller
{
    public function addcoupon(request $request)
    {
        $user_id=Redis::hmget("admin",["user_id"]);
        $user_id=implode("",$user_id);
        if(!$user_id){
            return $this->error('未登录');
        }
        $goods_id = $request->goods_id;
//        dd($goods_id);
        $coupon_id = $request->coupon_id;
//        dd($coupon_id);
        $goods = Goods::where(['is_show'=>1,'goods_id'=>$goods_id])->count();
//        dd($goods);
        if(!$goods || !$coupon_id){
            return $this->jsonResponse('1003','商品已下架或者缺少参数');
        }
        $data = ['user_id'=>$user_id,'coupon_id'=>$coupon_id,'goods_id'=>$goods_id];
        $count = DB::table('user_coupon')->where($data)->count();
        if($count){
            return $this->jsonResponse('1004','该优惠券您已经领取过了');
        }
        $res = DB::table('user_coupon')->insert($data);
        if($res){
            return $this->jsonResponse('0','领取优惠券成功');
        }
    }
//收藏
    public function collect(request $request)
    {
        $goods_id = $request->goods_id;
//        dd($goods_id);
        $user_id=Redis::hmget("admin",["user_id"]);
        $user_id=implode("",$user_id);
        if(!$user_id){
            return $this->error('未登录');
        }
        $where=[
            'user_id'=>$user_id,
            'goods_id'=>$goods_id
        ];
        $count = DB::table('collect')->where($where)->count();
        if($count){
            return $this->jsonResponse('1004','该商品您已经收藏过了');
        }
        $res = DB::table('collect')->insert($where);
        if($res){
            return $this->jsonResponse('0','收藏成功');
        }

    }
}
