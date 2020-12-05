<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
class GoodsController extends Controller
{
//    列表页
    public function goods_list($cate_id)
    {
        $query=request()->price;
         $res = request()->all();
//        商品列表展示
        $url = "http://www.2001api.com/goods/goods_list/{$cate_id}?price=".$query;
        $goods_list = curl_get($url);
        // dd($goods_list);
        $data = json_decode($goods_list['data'],true);
        $urls = request()->url();
//        dd($urls);
        return view('index/goods/goods_list',['data'=>$data,'query'=>$query,'urls'=>$urls]);
    }
        public function search(){
        $goods_name = request()->goods_name;
        $where = [];
        if($goods_name){
            $where[] = ['goods_name','like',"%$goods_name%"];
        }
        $listModel = new Goods();
        $data = $listModel->where($where)->orderBy('goods_id','desc')->get();
        $query = request()->all();
         return view('index/goods/goods',['data'=>$data,'query'=>$query]);
        }

        public function video(){
           $goods = Goods::where('is_del','1')->orderBy('goods_id','desc')->get();

           return view('index/goods/room',['goods'=>$goods]);
        }
}
