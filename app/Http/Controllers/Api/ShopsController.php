<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class ShopsController extends Controller
{
	public function shops(){
		
    	//首页幻灯片
    	$goods=new Goods;
    	$slice=$goods->getslice();

    	$goods2=Goods::where(['is_up'=>1,'seller_id'=>2,'is_show'=>1])->get();
    	$goods3=Goods::where(['is_up'=>1,'seller_id'=>3,'is_show'=>1])->get();
    	$goods4=Goods::where(['is_up'=>1,'seller_id'=>4,'is_show'=>1])->get();
		// dd($goods2);

    	$msg=[
    		'goods'=>$goods,
    		'slice'=>$slice,
    		'goods2'=>$goods2,
    		'goods3'=>$goods3,
    		'goods4'=>$goods4,
    	];
    	// dd($slice);
    	$msg = json_encode($msg);
    	// dd($slice);
        $msg = ["ok","data"=>$msg];
        // dd($slice);
    	return $msg;
    }
}
