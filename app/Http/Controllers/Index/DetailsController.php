<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Helpers\Cull;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redis;
class DetailsController extends Controller
{
    public function details(Request $request){
        // Cookie::queue("aa","ddff");

           

        // $aa = $request->cookie("aa");

        //     dd($aa);

            
            
        

        $goods_id = request()->post("goods_id");
        // dd($goods_id);


         $user_id=Redis::hmget("admin",["user_id"]);
        $user_id=implode("",$user_id);
        $url ="http://www.2001api.com/details?goods_id=".$goods_id;

        $data = curl_get($url);
        // dd($data);
        $data = json_decode($data['data'],true);
        // dd($data);
            // if($user_id==""){
            //     $historyList[]=['goods_id'=>$goods_id,'look_time'=>time()];
            //     // dd($historyList);
            //     $historyList=serialize($historyList);
            //     // dd($historyList);
            //     Cookie::queue('historyInfo',$historyList);

            //     // $historyList = ["ok","data"=>$historyList];
            //     // return $historyList;
            // }
        if($user_id==""){
                        //先从cookie中取值，判断cookie是否存在
                $historyList=Cookie::get('historyInfo');
                $historyList=unserialize($historyList);
                // dd($historyList);
                if (!empty($historyList)) {
                    // dump(2);
                       //从cookie中取出商品ID列，判断当前商品是否存在
                        $goods_ids=array_column($historyList,'goods_id');
                        // dd($goods_ids);
                        if (in_array($goods_id,$goods_ids)) {
                            //如果该商品已存在，将浏览时间更新为当前时间,并将信息从新加入cookie
                            $historyList[$goods_id]['look_time']=time();
                            $historyList=serialize($historyList);
                            Cookie::queue('historyInfo',$historyList);
                        }else{
                            //如果商品不存在cookie，则进行添加
                            $historyList[$goods_id]=['goods_id'=>$goods_id,'look_time'=>time()];
                            //将要存入的商品信息序列化存入cookie
                            $historyLists=serialize($historyList);
                            Cookie::queue('historyInfo',$historyLists);
                        }
                }else{
                    //如果cookie不存在，存cookie 
                    $historyList[$goods_id]=['goods_id'=>$goods_id,'look_time'=>time()];
                    //将要存入的商品信息序列化存入cookie
                    $historyList=serialize($historyList);
                    Cookie::queue('historyInfo',$historyList);
                    // $historyList = ["ok","data"=>$historyList];
                // return $historyList;
                }

            }



   
      
        return view("index.details.details",compact('data'));
    }
}
