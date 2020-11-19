<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Cate;

class IndexController extends Controller
{
    public function index(){
      
    	//首页推荐位
    	$url='http://www.2001api.com/domain/index';
    	
		$goods=curl_get($url);
		
    	return view('index.index.index',compact('goods'));
    }
}
