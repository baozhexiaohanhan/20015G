<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\History;
use App\Model\Goods;

class HistoryController extends Controller
{
    public function history(){
    	$user_id=1;
    	// $goods_id=History::where(['user_id'=>$user_id])->orderBy('look_time','desc')->pluck('goods_id')->toArray();
    	// // dd($goods_id);
    	// if(!empty($goods_id)){
    	// 	$goods_id=array_unique($goods_id);//去重
    	// 	$goods_id=implode(',',$goods_id);
    	// 	$historyInfo=Goods::where(['goods_id'=>$goods_id])->get();//获取浏览的商品id
    	// 	dd($historyInfo);
    	// }

    	$goods_id=History::where(['user_id'=>$user_id])->orderBy('look_time','desc')->pluck('goods_id')->toArray();
    	$goods_id=array_unique($goods_id);//去重
    	// dd($goods_id);
    	$goods=Goods::whereIn('goods_id',$goods_id)->get();
    	// dd($goods);
    	
    	
    }
    //添加浏览历史记录到数据库
    public function saveHistory(Request $request){
    	 $goods_id = 123;
        dd($goods_id);
    }
    //添加浏览历史记录到cookie
    public function historycookie(){

    }
    public function test(){

    }
}
