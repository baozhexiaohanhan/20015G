<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;

class IndexController extends Controller
{
   
    public function index(){
    	$cate=Cate::get();
    	// dd($cate);
    	$cate=self::createTree($cate,'cate_id');
    	// dd($cate);
    	$goods=Goods::where(['is_up'=>1,'cate_id'=>4,'is_show'=>1])->get();
    	// dd($goods);
    	// $goods1=Goods::where(['is_up'=>1,'cate_id'=>5,'is_show'=>1])->get();
    	return $goods;
    }
    public function indexa(){
    	$cate=Cate::get();
    	// dd($cate);
    	$cate=self::createTree($cate,'cate_id');
    	// dd($cate);
    	$goods1=Goods::where(['is_up'=>1,'cate_id'=>5,'is_show'=>1])->get();
    	
    	return $goods1;
    }
    public function indexb(){
    	$cate=Cate::get();
    	// dd($cate);
    	$cate=self::createTree($cate,'cate_id');
    	// dd($cate);
    	$goods2=Goods::where(['is_up'=>1,'cate_id'=>30,'is_show'=>1])->get();
    	
    	return $goods2;
    }
     public function indexc(){
    	$cate=Cate::get();
    	// dd($cate);
    	$cate=self::createTree($cate,'cate_id');
    	// dd($cate);
    	$goods3=Goods::where(['is_up'=>1,'cate_id'=>6,'is_show'=>1])->get();
    	
    	return $goods3;
    }
     public function indexd(){
    	$cate=Cate::get();
    	// dd($cate);
    	$cate=self::createTree($cate,'cate_id');
    	// dd($cate);
    	$goods4=Goods::where(['is_up'=>1,'cate_id'=>7,'is_show'=>1])->get();
    	
    	return $goods4;
    }
    public function indexe(){
    	$cate=Cate::get();
    	// dd($cate);
    	$cate=self::createTree($cate,'cate_id');
    	// dd($cate);
    	$goods5=Goods::where(['is_up'=>1,'cate_id'=>36,'is_show'=>1])->get();
    	
    	return $goods5;
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
