<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class GoodsController extends Controller
{
//    商品列表
    public function goods_list()
    {

        $goods_list = DB::table('goods')->where('cate_id',4)->get();
//        $goods = json_encode($goods_list);
//        $goods_price = Goods::where("is_show",1)->whereIn("cate_id",4)->max("goods_price");
        $goods_price = 2999;
//        $price = $this->price($goods_price);
        $length=strlen($goods_price);
        // dump($length);
        $foemat='400'.str_repeat(0, $length-4);
        //dd($aa);
        $maxprice=substr($goods_price,0,1);
        $maxprice=$maxprice*$foemat;
        // dd($maxprice);

        //计算价格阶段
        $price=[];
        $avgprice=$maxprice/5;
        for($i=0,$j=1;$i<$maxprice;$i++,$j++){
            $price[]=$i.'-'.$avgprice*$j.'元';
            $i=$avgprice*$j-1;
        }
        $price[]=$maxprice.'元以上';
//        return $price;
        $msg = [
            "goods_list"=>$goods_list,
            "goods_price"=>$price,
        ];
        return $msg;
    }
//    获取分类
    public function cate($cate_id)
    {
        $cate = DB::table('cate')->where('pid',$cate_id)->get();
        return $cate;
    }
//    获取品牌
    public function brand()
    {
        $brand = DB::table('brand')->get();
        return $brand;
    }
    public function price($goods_price)
    {


    }
}
