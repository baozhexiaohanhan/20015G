<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;
use App\Model\Notice;
use App\Model\Category;
use App\Model\Seller;
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
        //导航
        $daohang = Seller::where("is_slice",0)->get();
		// dd($daohang);
		$msg1 = [
			"goods"=>$goods,
			"goods1"=>$goods1,
			"goods2"=>$goods2,
			"goods3"=>$goods3,
			"goods4"=>$goods4,
            "goods5"=>$goods5,
            "daohang"=>$daohang,
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
    public function notice(){
    	$notice = Notice::all()->toArray();
        // dd($notice);
    	$msg = json_encode($notice);
    	$data = ['code'=>200,'msg'=>"返回成功请稍后！！",'msg'=>$msg];
    	return $data;
    }

    public function fenlei(){
    	$catedata = Cate::get();
		$catedata=self::getleftInfo($catedata,'cate_id');
    	$msg = json_encode($catedata);
    	$data = ['code'=>300,'msg'=>"返回成功请稍后！！",'msg'=>$msg];
    	return $data;
    }
     public static function getleftInfo($leftInfo,$pid=0)//三个参数与上面index方法里面穿的参数相对应
    {
        $arr=[];
        foreach($leftInfo as $k=>$v){
            //  dump($v['cate_name']);
            if($v['pid']==$pid){
            //   dump($v['cate_name']);
            //采用递归的方式，自己调用自己 并且是后进现出
            
            $child=self::getleftInfo($leftInfo,$v['cate_id']);
            $v['child']=$child;
            $arr[]=$v;
            }
        }
        return  $arr;
    }
 
}
