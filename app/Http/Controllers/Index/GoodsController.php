<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class GoodsController extends Controller
{
//    列表页
    public function goods_list($cate_id)
    {
        // $goods_id=request()->all();
        // dd($goods_id);
        //浏览历史记录
        // $user_id = 1;
        $urls = "http://www.2001api.com/history";
        $history = curl_get($urls);
        // dd($history);
        $history = json_decode($history['data'],true);
        // dd($history);


//        商品列表展示
        $url = "http://www.2001api.com/goods/goods_list/{$cate_id}";
        $goods_list = curl_get($url);
        $data = json_decode($goods_list['data'],true);
        $query = request()->all();
       // dd($query);
        if(isset($query['price'])){
            $price_array = explode('元',$query['price']);
            $price_array = explode('-',$price_array[0]);
            $where = [
                'goods_price','>',$price_array[0],
            ];
            if(isset($price_array[1])){
                $where[] = [
                    'shop_price','<',$price_array[1],
                ];
            }
            if(isset($query['brand_id'])){
                $where[] = [
                    'brand_id','=',$query['brand_id']
                ];
            }
//            dd($where);
        }
//        dd($_SERVER);
        $urls = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
//        dd($urls);
        return view('index/goods/goods_list',['data'=>$data,'query'=>$query,'url'=>$urls,'history'=>$history]);
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
}
