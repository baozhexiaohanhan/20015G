<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\History;
use App\Model\Goods;

class HistoryController extends Controller
{
     public function historys(){
        $user_id=1;
        $goods_id = request()->goods_id;
        // dd($user_id);
        //根据用户id 获取修改用户浏览的商品 根据时间倒序 获取前几条
        $history=History::leftjoin('goods','goods.goods_id','=','history.goods_id')
                ->where('user_id',$user_id)->orderBy('history.look_time','desc')->limit(12)->get();
                // dd($history);
        // if(count($history)>0){
        //     //查到获取浏览信息
        //     $history=['ret'=>$history];
        //     // dd($history);
        // }else{
        //     $history=['ret'=>[]];
        //     // dd($history);
        // }
        // return json_encode($history);
        // $history=[
        //     'user_id'=>$user_id,
        //     'history'=>$history
        // ];
        $history = json_encode($history);
        $history = ["ok","data"=>$history];
        return $history;
    }
}
