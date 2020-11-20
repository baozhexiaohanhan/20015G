<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class GoodsController extends Controller
{
//    列表页
    public function goods_list($cate_id)
    {
//        dd($cate_id);

//        商品列表展示
        $list = DB::table('goods')->get();
//        dd($list);
//         选择商品分类
        $cateall = DB::table('cate')->where(['pid'=>0])->get();
//        获取分类
        $cate = DB::table('cate')->where('pid',$cate_id)->get();
//        dd($cate);
//        获取品牌
        $brand = DB::table('brand')->get();

        return view('index/goods/goods_list',['list'=>$list,'cateall'=>$cateall,'cate'=>$cate,'brand'=>$brand]);
    }
}
