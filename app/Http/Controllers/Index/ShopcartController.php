<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order_info;
use App\Model\Order_goods;
use App\Model\Region;
use App\Model\Address;
use App\Model\Cart;
use App\Model\Goods;
use App\Model\Products;
use DB;
use App\Model\Order;
use App\Model\Coupon;
use Illuminate\Support\Facades\Redis;
class ShopcartController extends Controller
{
    //购物车订单
    public function shopcart(Request $request){
        $rec_id = request()->post("rec_id");
        // dd($rec_id);

        $url = "http://www.2001api.com/shop/shopcart?rec_id=".$rec_id;

        $data = curl_get($url);
        // dd($data);
        $data = json_decode($data['msg'],true);
        // dd($data); 

        return view('index/shopcart/shopcart',compact('data'));
    }
    //收货地址
    public function address(){

        $url = "http://www.2001api.com/shop/address";

        $data = curl_get($url);
        // dd($data);
        $data = json_decode($data['msg'],true);
        // dd($data); 

        return view('index/address/address',compact('data'));
    } 
    //添加三级联动地址
    public function address_add(Request $request){
        // $region_id  = $request->region_id;
        $region_id = request()->post("region_id");
        
        $region_son = Region::where('parent_id',$region_id)->get();
        return json_encode(['code'=>0,'msg'=>'OK','data'=>$region_son]);
    }
    //执行添加收货地址
    public function address_do(Request $request){
        // $rec_id = request()->post("rec_id");
        $user_id = Redis::hmget("admin",["user_id"]);
        // dd($user_id);
        $post = $request->except('_token');
        // dd($post);
        $user_id = implode(",",$user_id);
        $post['user_id'] = $user_id;
        // dd($post);
        
        $res = Address::insert($post);
        if($res){
            return  redirect('/shopcart');
        }
    }
//  删除收货地址
    public function destroy(){
//  $brand_id = $request->input('id');
        $ids = Request()->all();
        // dd($ids);
        if(!$ids){
            return $this->JsonResponse('11','请选择要删除的数据');
        }
        foreach ($ids as $k=>$v){
            $isdel = Address::destroy($v);
        }
//  dd($isdel);
        if($isdel){
            return $this->JsonResponse('0','OK');
        }else{
            return $this->JsonResponse('1','删除失败');
        }
    }

    public function show($id)
    {
        $addressModel = new Address();
        $region = Region::where('parent_id',0)->get();
        $data = $addressModel->where('address_id',$id)->first();
    //    dd($data);
        return view('index/address/update',['data'=>$data,'region'=>$region]);
    }

    public function edit(){
        
    }
    

    //生成订单 and  订单商品
    public function order(Request $request){
        $datas = $request->all();
        // $data=request()->all();
        // dd($datas);
        $cart_id=$data['cart_id'];
        $data['order_sn']=$this->createOrderSn();
        $data['user_id']=session('reg')->user_id;
        //支付方式
        //收货地址
        if($data['address_id']){
              $userAddress=Address::where('id',$data['address_id'])->first();
              $userAddress=$userAddress ? $userAddress->toArray():[];
        }
        //商品总价
        $total=DB::select("select sum(goods_price*buy_number) as price from shop_cary where cary_id in($cart_id)");
        $goods_total=$total[0]->price;
        $data['goods_price']=$goods_total;
        
        //支付价格
        $data['order_amount']=$data['goods_price'];
        //添加时间
        $data['addtime']=time();
        $data=array_merge($data,$userAddress);
       
        unset($data['id'],$data['add_time'],$data['is_del'],$data['is_moren'],$data['address_id'],$data['cart_id']);
        $order_id=Order::insertGetId($data);
       //  dd($order);
         if($order_id){
           //订单商品入库
           if(is_string($cart_id)){
               $cart_id=explode(',',$cart_id);     
           }
           // dd($cart_id);
           $goods=Cary::whereIn('cary_id',$cart_id)->get();
           $goods=$goods?$goods->toArray():[];
           // dd($goods);
           foreach($goods as $k=>$v){
               // print_r($v);
               $goods[$k]['order_id']=$order_id;
               unset($goods[$k]['cary_id'],$goods[$k]['user_id'],$goods[$k]['add_time'],$goods[$k]["is_del"]);
           }
           // dd($goods);
           $OrderGoods=OrderGoods::insert($goods);
         
           if($OrderGoods){
               Cary::destroy($cart_id);
               return $this->success('0000','结算',$order_id);
           }
          
       }  
     
   }
    


    // 沙箱支付
    public function pay(){
        // 普通订单
        $order_id = request()->order_id;
        $or_id = request()->or_id;
        // dump($or_id);
        if($or_id){
           $order =  Order::where("order_id",$or_id)->pluck("order_sn")->toArray();
           $order_price =  Order::where("order_id",$or_id)->sum("order_price");
            // dd($order_price);
           $order_name = ['多商品支付'];

        //    dd($order_name);
        }
        if($order_id){
            // dd(11);
            $order = Order_info::where("order_id",$order_id)->pluck("order_sn")->toArray();

            $order_price = Order_info::where("order_id",$order_id)->sum("order_price");
            $order_id = explode(",",$order_id);
            $order_name = Order_goods::whereIn("order_id",$order_id)->pluck("goods_name")->toArray();
            // dd($order_name);

         }
        $orders = request()->order;
        if($orders){
            $ordera = explode(",",$orders);
            $info = Redis::hgetall($orders);
            $kk = "order_sn".$info['order_sn'];
            Redis::hmset($kk,$ordera);
        }
        // $res = Redis::hgetall($kk);
        $config = config("alipay");
        require_once app_path('Common/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('Common/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
        
        // dd($order);
        if($orders){
            //使用SQL查询订单信息
            //使用SQL查询订单信息
           
            // dd($order_name);
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $info['order_sn'];
        
            //订单名称，必填
            $subject = $info['name'];
        
            //付款金额，必填
            $total_amount = $info['order_price'];
        }else{
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = implode("\r\n",$order);
        
            //订单名称，必填
           
            $subject = implode("\r\n",$order_name);
        
            //付款金额，必填
            $total_amount = $order_price;
        }
            //商品描述，可空
            $body = "";
        
            //构造参数
            $payRequestBuilder = new \AlipayTradePagePayContentBuilder();
            $payRequestBuilder->setBody($body);
            $payRequestBuilder->setSubject($subject);
            $payRequestBuilder->setTotalAmount($total_amount);
            $payRequestBuilder->setOutTradeNo($out_trade_no);
        
            $aop = new \AlipayTradeService($config);
        
            /**
             * pagePay 电脑网站支付请求
             * @param $builder 业务参数，使用buildmodel中的对象生成。
             * @param $return_url 同步跳转地址，公网可以访问
             * @param $notify_url 异步通知地址，公网可以访问
             * @return $response 支付宝返回的信息
             */
            $response = $aop->pagePay($payRequestBuilder,$config['return_url'],$config['notify_url']);
        
            //输出表单
            // var_dump($response);
            //  改变订单号查出订单号的格式
    }
    public function return_url(){
        $config =config("alipay");
        require_once app_path('Common/alipay/pagepay/service/AlipayTradeService.php');
        $arr = $_GET;
        // dd($arr);
        $out_trade_no = $arr['out_trade_no'];
        // trim($out_trade_no);
        // dump($out_trade_no);
     
            $order_snss = $arr['out_trade_no'];
            $order_sns = explode(",",$order_snss);
            // dd($order_sns);
        
        // dd($order_sns);
        // $out_trade_no = explode(",",$out_trade_no);
        // $out_trade_no = array_chunk($out_trade_no,2);
        // dd($out_trade_no);
        $kk = "order_sn".$arr['out_trade_no'];
        $res = Redis::hgetall($kk);
        $order_id = implode(",",$res);
        // dd($order_id);
        if($res){
            Redis::hmset($order_id,
                "order_status",1,
                "pay_status",1,
            );
        }
        $datas = Redis::hgetall($order_id);
        unset($datas['name']);
        // dd($data);
        
        $aop = new \AlipayTradeService($config);
        $result = $aop->check($arr);
        $id = Order::select("order_id")->where("order_sn",$order_sns)->first();
        // dd($id);
        if(!$id){
            $hao = Order_info::select("order_id")->where("order_sn",$order_sns)->first();
            if($hao){
                $count = Order_info::whereIn('order_id',$hao)->count();
            }
            // dd(11);
        }
        if($id){
            $count = Order::whereIn('order_id',$id)->count();
        }
        
                /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        // dd(11);
        if(!$res){
            // dd(11);
            if($result) {//验证成功
                if(!$count){
                    return '发生重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中！请联系客服';
                }
                // if($arr['seller_id']!=config('alipay.seller_id')){
                //     return '发生重大事故:商家UID'.$arr['seller_id'].'和系统商家不符！请联系客服';
                // }
                if($arr['app_id']!=config('alipay.app_id')){
                    return '发生重大事故:应用ID'.$arr['app_id'].'和系统商家不符！请联系客服';
                }

                $data = [
                    "order_status"=>1,
                    "pay_status"=>1,
                ];
                // dd(11);
            //   $order_id = implode(",",$order_id);
              if($id['order_id']){
                    $update = Order_info::where('or_id',$id['order_id'])->update($data);
              }else{
                $update = Order_info::where('order_id',$hao['order_id'])->update($data);
              }
                // dd($update);
                if($update){
                    return redirect("/udai_order");
                }else{
                    return "修改失败";
                }
            }else {
                //验证失败
                echo "验证失败";
            }
        }else{
            // dd(22);
            if($result) {//验证成功
                if(!$datas){
                    return '发生重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中！请联系客服';
                }
                // if($arr['seller_id']!=config('alipay.seller_id')){
                //     return '发生重大事故:商家UID'.$arr['seller_id'].'和系统商家不符！请联系客服';
                // }
                if($arr['app_id']!=config('alipay.app_id')){
                    return '发生重大事故:应用ID'.$arr['app_id'].'和系统商家不符！请联系客服';
                }
                // dump($datas);
                $a['seller_id'] = $datas['seller_id'];
                $a['goods_id'] = $datas['goods_id'];
                $a['goods_sn'] = $datas['goods_sn'];
                $a['buy_number'] = $datas['buy_number'];
                $a['goods_name'] = $datas['goods_name'];
                $a['shop_price'] = $datas['order_price'];
                // dd($a);

                // $a[''] = $datas[''];
                unset($datas['goods_id']);
                unset($datas['goods_sn']);
                unset($datas['buy_number']);
                unset($datas['goods_name']);
                $order_ida = Order_info::insertGetId($datas);
                $a['order_id'] = $order_ida;
                $res2 = Order_goods::insert($a);

                
                
                // dd($res2);
                if($res2){
                    return redirect("/udai_order");
                }else{
                    return "修改失败";
                }
            }else {
                //验证失败
                echo "验证失败";
            }
        }
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //请在这里加上商户的业务逻辑程序代码
            
            //——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

            //商户订单号
            // $out_trade_no = htmlspecialchars($_GET['out_trade_no']);

            // //支付宝交易号
            // $trade_no = htmlspecialchars($_GET['trade_no']);
                
            // echo "验证成功<br />支付宝交易号：".$trade_no;

            //——请根据您的业务逻辑来编写程序（以上代码仅作参考）——
            
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
           
    }
   
}
