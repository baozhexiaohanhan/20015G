<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
       // echo "11111";die;
    	//首页推荐位
    	$url='http://www.2001api.com/domain/index';
    	$urla='http://www.2001api.com/domain/indexa';
    	$urlb='http://www.2001api.com/domain/indexb';
    	$urlc='http://www.2001api.com/domain/indexc';
    	$urld='http://www.2001api.com/domain/indexd';
    	$urle='http://www.2001api.com/domain/indexe';
    	// dd($url);
    	$goods=curl_get($url);
    	// dd($goods);
    	$goods1=curl_get($urla);
    	// dd($goods1);
    	$goods2=curl_get($urlb);
    	// dd($goods2);
    	$goods3=curl_get($urlc);
    	// dd($goods3);
    	$goods4=curl_get($urld);
    	// dd($goods4);
    	$goods5=curl_get($urle);
    	// dd($goods5);
    	return view('index.index.index',compact('goods','goods1','goods2','goods3','goods4','goods5'));
    }
}
