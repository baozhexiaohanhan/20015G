<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order_info;
use App\Model\Order_goods;

class OrderController extends Controller
{
    public function order_index(){
        $user = session()->get("seller");
        $res = Order_info::where("seller_id",$user['seller_id'])->get();
        // dd($res);
        return view("admin.business.order_index",compact("res"));

    }
}
