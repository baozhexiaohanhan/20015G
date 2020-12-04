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
        // dd($query);
        // if($query==""){
            
        // }
        // $query = $query['price'];
        // dd($query);
        //浏览历史记录
        // $user_id = 1;
        // $urls = "http://www.2001api.com/history";
        // $history = curl_get($urls);
        // // dd($history);
        // $history = json_decode($history['data'],true);
        // dd($history);
         $res = request()->all();
//        商品列表展示
        $url = "http://www.2001api.com/goods/goods_list/{$cate_id}?price=".$query;
        $goods_list = curl_get($url);
        // dd($goods_list);
        $data = json_decode($goods_list['data'],true);
        // dd($data);
//         $query = request()->all();
//        // dd($query);
//         if(isset($query['price'])){
//             $price_array = explode('元',$query['price']);
//             $price_array = explode('-',$price_array[0]);
//             $where = [
//                 'goods_price','>',$price_array[0],
//             ];
//             if(isset($price_array[1])){
//                 $where[] = [
//                     'shop_price','<',$price_array[1],
//                 ];
//             }
//             if(isset($query['brand_id'])){
//                 $where[] = [
//                     'brand_id','=',$query['brand_id']
//                 ];
//             }
// //            dd($where);
//         }
//        dd($_SERVER);
        // $urls = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $urls = request()->url();
//        dd($urls);
        return view('index/goods/goods_list',['data'=>$data,'query'=>$query,'urls'=>$urls]);
    }

//     public function list($cate_id){
//          ob_start();

//         $urls = "http://www.2001api.com/history";
//         $history = curl_get($urls);
//         // dd($history);
//         $history = json_decode($history['data'],true);
//         // dd($history);


// //        商品列表展示
//         $url = "http://www.2001api.com/goods/goods_list/{$cate_id}";
//         $goods_list = curl_get($url);
//         $data = json_decode($goods_list['data'],true);
//         $query = request()->all();
//        // dd($query);
//         if(isset($query['price'])){
//             $price_array = explode('元',$query['price']);
//             $price_array = explode('-',$price_array[0]);
//             $where = [
//                 'goods_price','>',$price_array[0],
//             ];
//             if(isset($price_array[1])){
//                 $where[] = [
//                     'shop_price','<',$price_array[1],
//                 ];
//             }
//             if(isset($query['brand_id'])){
//                 $where[] = [
//                     'brand_id','=',$query['brand_id']
//                 ];
//             }
// //            dd($where);
//         }
// //        dd($_SERVER);
//         $urls = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
// //        dd($urls);

//         echo  view('index/goods/goods_list',['data'=>$data,'query'=>$query,'url'=>$urls,'history'=>$history]);
        
//           $contents = ob_get_contents();
          
//           $filename = 'list.html';
//           file_put_contents($filename, $contents);
//           ob_clean();  
//     }
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
