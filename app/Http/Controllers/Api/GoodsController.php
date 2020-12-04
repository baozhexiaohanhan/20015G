<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;

class GoodsController extends Controller
{
//    商品列表
    public function goods_list($cate_id)
    {


        //        统计点击量
//        $hits = Redis::setnx('hit_'.$goods_id,1)?:Redis::incr('hit_'.$goods_id,1);
        $hits =Redis::zincrby('hit',1,'hit_'.$cate_id);
//        dd($hits);
//        取点击量最高的五条
        $hitgoods = Redis::zrevrange('hit',0,10);
//        dd($hitgoods);
        if($hitgoods){
            $hit_goods_id = [];
            foreach ($hitgoods as $v){
                $hitsarr = explode('_',$v);
                $hit_goods_id[] = $hitsarr[1];
            }
//            dd($hit_goods_id);
            $hot_goods = DB::table('goods')->whereIn('goods_id',$hit_goods_id)->get();


        $goods_name = request()->goods_name;
        $where = [];
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];

        }
//        获取所有分类
        $soncate_id = DB::table('cate')->where('pid',$cate_id)->pluck('cate_id')->toArray();
        array_push($soncate_id,$cate_id);
//        根据分类查询商品
        $goods = DB::table('goods')->where($where)->where('is_new',1)->whereIn('cate_id',$soncate_id)->paginate(10);
        // dd($goods);
//         根据商品查询商品所拥有的品牌
        $brand_ids = DB::table('goods')->where('is_new',1)->whereIn('cate_id',$soncate_id)->pluck('brand_id')->toArray();
        $brand_ids = array_unique($brand_ids);
        $brand = DB::table('brand')->select('brand_id','brand_name')->whereIn('brand_id',$brand_ids)->get();
//       根据商品查询商品的最大价格 并计算价格阶段
        $shop_price = DB::table('goods')->where('is_new',1)->whereIn('cate_id',$soncate_id)->max('goods_price');
//        dd($shop_price);
        $length = strlen($shop_price);
//        dump($length);
        $format = '1'.str_repeat(0,$length-4);
//        dd($format);
        $maxprice = substr($shop_price,0,1);
        $maxprice = $maxprice*$format;
//        dd($maxpeice);
        $price = [];
        $avgprice = $maxprice/5;
        for ($i=0,$j=1;$i < $maxprice;$i++,$j++){
            $price[] = $i.'-'.$avgprice*$j.'元';
            $i = $avgprice*$j-1;
        }
        $price[] = $maxprice.'元以上';
//        dd($price);
        $msg = [
            'goods'=>$goods,
            'brand'=>$brand,
            'price'=>$price,
            "hot_goods"=>$hot_goods
        ];
        $msg = json_encode($msg);
        $msg = ["ok","data"=>$msg];
        return $msg;
    }
}
