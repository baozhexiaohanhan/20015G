<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Seller;
use App\Model\Region;

class UserindexController extends Controller
{
    public function user_index(){
        $data = Seller::where("is_del",0)->get();
        return view("admin.user.user_index",compact("data"));
    }
    public function user_index_up(){
        $is_lock = request()->is_lock;
        $seller_id = request()->seller_id;
        // dd($seller_id);
        $res = Seller::where("seller_id",$seller_id)->update(['is_lock'=>$is_lock]);
        if($res){
            return $message = [
                "code"=>0004,
                "msg"=>"获取到",
            ];
        }
    }
    public function user_index_del(){
        $seller_id = request()->seller_id;
        $res = Seller::where("seller_id",$seller_id)->update(['is_del'=>1]);
        if($res){
            return $message = [
                "code"=>0004,
                "msg"=>"获取到",
            ];
        }
    }
}
