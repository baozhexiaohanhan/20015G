<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;

class IndexController extends Controller
{
    public function index(){
       // echo "11111";die;

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
    	// dd($catedata);
    	//楼层
		$goods=curl_get($url);
//        dd($goods);

		$goods = json_decode($goods['ret']);
    	return view('index.index.index',compact('goods','notice','catedata'));
    }

}
