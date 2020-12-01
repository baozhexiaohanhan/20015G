<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Seller;
class ShopsController extends Controller
{
	public function shops(){
		
    	//首页幻灯片
    	$goods=new Goods;
    	$slice=$goods->getslice();
		$seller_id = request()->seller_id;
    	$goods=Goods::where(['is_up'=>1,'seller_id'=>$seller_id,'is_show'=>1])->limit(24)->get();
    	$seller = Seller::where("seller_id",$seller_id)->first();
    	$msg=[
    		'goods'=>$goods,
			'slice'=>$slice,
			'seller'=>$seller,
    	];
    	// dd($slice);
    	$msg = json_encode($msg);
    	// dd($slice);
        $msg = ["ok","data"=>$msg];
        // dd($slice);
    	return $msg;
    }
}
