<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;
use Illuminate\Support\Facades\Redis;
class IndexController extends Controller
{
    public function index(){
		$user_name = Redis::hmget("admin",["user_name"]);
		$user_name = implode("|",$user_name);
		//1 $user_name = ["user_name"=>$user_name];
		session(['name'=>$user_name]);
		// $res = session()->get("name");
		// dd($res);

    	//首页推荐位
    	$url='http://www.2001api.com/domain/index';
    	$url2 ='http://www.2001api.com/domain/notice';
    	$url3 = 'http://www.2001api.com/domain/fenlei';
        //公告
    	$notice = curl_get($url2);
    	$notice = json_decode($notice['msg']);
    	//无限极分类
    	$catedata = curl_get($url3);
    	$catedata = json_decode($catedata['msg']);
//    	 dd($catedata);
    	//楼层
		$goods=curl_get($url);
       // dd($goods);

		$goods = json_decode($goods['ret']);
    	return view('index.index.index',compact('goods','notice','catedata'));
	}


  public function indexdo(){
         ob_start();
    $user_name = Redis::hmget("admin",["user_name"]);
    $user_name = implode("|",$user_name);
    session(['name'=>$user_name]);

      //首页推荐位
      $url='http://www.2001api.com/domain/index';
      $url2 ='http://www.2001api.com/domain/notice';
      $url3 = 'http://www.2001api.com/domain/fenlei';
        //公告
      $notice = curl_get($url2);
      $notice = json_decode($notice['msg']);
      //无限极分类
      $catedata = curl_get($url3);
      $catedata = json_decode($catedata['msg']);
//       dd($catedata);
      //楼层
       $goods=curl_get($url);
       // dd($goods);
// 
       $goods = json_decode($goods['ret']);
       // dd($goods);

         echo  view('index.index.index',compact('goods','notice','catedata'));
        
          $contents = ob_get_contents();
          
          $filename = 'index.html';
          file_put_contents($filename, $contents);
          ob_clean();  


  }


}
