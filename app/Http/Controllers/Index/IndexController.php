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
    	
		$goods=curl_get($url);
//        dd($goods);

		$goods = json_decode($goods['ret']);
    	return view('index.index.index',compact('goods'));
    }

}
