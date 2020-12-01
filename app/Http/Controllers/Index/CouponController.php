<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CouponController extends Controller
{
//    优惠券
    public function addcoupon(Request $request)
    {
        $data = $request->all();
        $url = "http://www.2001api.com/addcoupon";
        $coupon_url = curl_post($url,$data);
////        dd($coupon_url);
//        $coupon = json_decode($coupon_url['data'],true);
    }
//    收藏
    public function collect(Request $request)
    {
        $data = $request->all();
        $url = "http://www.2001api.com/collect";
        $coupon_url = curl_post($url,$data);
////        dd($coupon_url);
//        $coupon = json_decode($coupon_url['data'],true);
    }
}
