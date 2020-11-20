<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class GoodsController extends Controller
{
//    列表页
    public function goods_list($cate_id)
    {
//        商品列表展示
        $url = 'http://www.2001api.com/goods/goods_list';
        $goods_list = curl_get($url);
//        $goods_list = json_decode($goods_list,true);
        dump($goods_list);
//        获取分类
        $cate_url = "http://www.2001api.com/goods/cate/{$cate_id}";
//        dd($cate_url);
        $cate = curl_get($cate_url);
//        dd($cate);
//        获取品牌
        $brand_url = 'http://www.2001api.com/goods/brand';
        $brand = curl_get($brand_url);
//        dd($brand);
        return view('index/goods/goods_list',['goods_list'=>$goods_list,'cate'=>$cate,'brand'=>$brand]);
    }
}
