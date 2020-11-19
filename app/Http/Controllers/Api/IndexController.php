<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;

class IndexController extends Controller
{
   
    public function index(){

	
		//dd($data);



		$cate=Cate::get();
		$cate=self::createTree($cate,'cate_id');
		$goods=Goods::where(['is_up'=>1,'cate_id'=>4,'is_show'=>1])->get();
		$goods1=Goods::where(['is_up'=>1,'cate_id'=>5,'is_show'=>1])->get();
		$goods2=Goods::where(['is_up'=>1,'cate_id'=>30,'is_show'=>1])->get();
		$goods3=Goods::where(['is_up'=>1,'cate_id'=>6,'is_show'=>1])->get();
    	$goods4=Goods::where(['is_up'=>1,'cate_id'=>7,'is_show'=>1])->get();
    	$goods5=Goods::where(['is_up'=>1,'cate_id'=>36,'is_show'=>1])->get();
		
		$msg1 = [
			"goods"=>$goods,
			"goods1"=>$goods1,
			"goods2"=>$goods2,
			"goods3"=>$goods3,
			"goods4"=>$goods4,
			"goods5"=>$goods5,
		];
		$msg = json_encode($msg1);
		$data = ['code'=>100,'msg'=>"返回数据成功","ret"=>$msg];
		
    	return $data;
    }
   
     public static function createTree($data,$pid=0,$level=0){
        if(!$data){
            return;
        }
        static $newarray=[];
        foreach ($data as $k=>$v) {
            if($v->pid==$pid){
                $v->level=$level;
                $newarray[$k]=$v;
                self::createTree($data,$v['cate_id'],$level+1);
            }
        }
        return $newarray;
    }
}
