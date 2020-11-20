<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CouponController extends Controller
{
    public function center()
    {
        return view('index/index/center');
    }
    public function coupon()
    {
//        echo 123;
        return view('index/coupon/coupon');
    }
}
