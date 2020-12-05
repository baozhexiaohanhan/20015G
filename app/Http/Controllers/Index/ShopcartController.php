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
        $orders = request()->order;
        $ordera = explode(",",$orders);
        // dd($ordera);
        $info = Redis::hgetall($orders);
        // dd($info);
        $order_id = request()->order_id;
       
        // $order_id = 4;
        $order_id = explode(",",$order_id);
        // dd($order_id);
        $kk = "order_sn".$info['order_sn'];
        Redis::hmset($kk,$ordera);
        // $res = Redis::hgetall($kk);
        // dd($res);
        // $order_id = 1;
        $config = config("alipay");
        require_once app_path('Common/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('Common/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
        $order = Order_info::whereIn("order_id",$order_id)->pluck("order_sn")->toArray();
        $order_price = Order_info::whereIn("order_id",$order_id)->sum("order_price");
        // dd($order);
        if($order){
            // dd(11);
            //使用SQL查询订单信息
           
            // dd($order);
           
            // dd($order_name);
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = implode("\r\n",$order);
        
            //订单名称，必填
           
            $order_name = Order_goods::whereIn("order_id",$order_id)->pluck("goods_name")->toArray();
            $subject = implode("\r\n",$order_name);
        
            //付款金额，必填
            $total_amount = $order_price;
        
        }else{
            // dd(22);
            //使用SQL查询订单信息
           
            // dd($order_name);
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $info['order_sn'];
        
            //订单名称，必填
           
            $subject = $info['name'];
        
            //付款金额，必填
            $total_amount = $info['order_price'];
        
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
    }
    public function return_url(){
        $config =config("alipay");
        require_once app_path('Common/alipay/pagepay/service/AlipayTradeService.php');
        $arr = $_GET;

        $kk = "order_sn".$arr['out_trade_no'];
        $res = Redis::hgetall($kk);
        $order_id = implode(",",$res);
        // dd($order_id);
        Redis::hmset($order_id,
            "order_status",1,
            "pay_status",1,
        );

        $data = Redis::hgetall($order_id);
        unset($data['name']);
        // dd($data);
        
        // dd($res2);
        $aop = new \AlipayTradeService($config);
        $result = $aop->check($arr);
        $count = Order_info::where(['order_sn'=>$arr['out_trade_no'],"order_price"=>$arr['total_amount']])->count();

                /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
        if(!$data){
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
                $update = Order_info::where(['order_sn'=>$arr['out_trade_no']])->update($data);
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
            if($result) {//验证成功
                if(!$data){
                    return '发生重大事故:订单号'.$arr['out_trade_no'].'和订单金额'.$arr['total_amount'].'不在当前系统中！请联系客服';
                }
                // if($arr['seller_id']!=config('alipay.seller_id')){
                //     return '发生重大事故:商家UID'.$arr['seller_id'].'和系统商家不符！请联系客服';
                // }
                if($arr['app_id']!=config('alipay.app_id')){
                    return '发生重大事故:应用ID'.$arr['app_id'].'和系统商家不符！请联系客服';
                }
                $res2 = Order_info::insert($data);
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
    //订单商品 订单 数据入库order info goods
    public function order_add(){
        // $a = request()->all();
        // dd($a);
        // if($a==)
        DB::beginTransaction();
        try {
        $da = request()->all();
        // dd($da);
        $order_sn['order_sn'] = $this->createOrderSn();
        $order_sn = $order_sn['order_sn'];
       
        $user_id = Redis::hmget("admin",["user_id"]);
        // dd($user_id);
        $user_id = implode(",",$user_id);
        if($user_id==""){
            return redirect("/log");
        }
      
        // 地址
        $address = Address::where(["user_id"=>$user_id])->first();
        // dd($address);
        // 支付方式
        $info = [1=>"微信",2=>"支付宝",3=>"货到付款"];
        $mode['pay_type'] =$info[$da['pay_type']];
        $mode = $mode['pay_type'];
        // dd($mode);
        // 总价价格
        $rec_id = $da['rec_id'];
        $rec_id = implode(",",$rec_id);
        $order_price = \DB::select("select sum(goods_price*buy_number) as tot from cart where rec_id in($rec_id) ");

        $order_price = $order_price[0]->tot;

        $rec_id = request()->rec_id;
        $seller_id = request()->seller_id;
        $seller_id = array_unique($seller_id);
        $arr = [];
        foreach($seller_id as $key=>$v){
            $cary = Cart::whereIn("rec_id",$rec_id)->leftjoin("coupon","cart.goods_id","=","coupon.range")->where("seller_id",$v)->get();
            $arr[$v]=$cary;
        }
      
        // dd($arr);
        $order_ids = [];
        foreach($arr as $k=>$v){
            $data['seller_id'] = $k;
            $data['order_sn'] = $this->createOrderSn();
            $data['user_id'] = $user_id;
            $data['consignee'] = $address['consignee'];
            $data['country'] = $address['country'];
            $data['email'] = $address['email'];
            $data['province'] = $address['province'];
            $data['city'] = $address['city'];
            $data['district'] = $address['district'];
            $data['address'] = $address['address'];
            $data['mobile'] = $address['tel'];
            $data['tel'] = $address['tel'];
            $data['best_time'] = 0;
            $data['sign_building'] = 0;
            $data['pay_name'] = $mode;
            $data['addtime'] = time();
            // dd($data);
            $order_id = Order_info::insertGetId($data);
            // dd($order_id);
            $order_ids[] = $order_id;
            if($order_id){
                $cart_id = [];
                $order_price = 0;
                foreach($v as $kk=>$val){
                    // dd($val);
                    $info = [];
                    $info['goods_id'] = $val['goods_id'];
                    $info['product_id'] = $val['product_id'];
                    $info['goods_name'] = $val['goods_name'];
                    if($val['name']){
                       
                        if($val['goods_price']>500){
                            $info['shop_price'] = $val['goods_price']-$val['type_ext'];

                        }else if($val['goods_price']>300){
                            $info['shop_price'] = $val['goods_price']-$val['type_ext'];

                        }
                    }else{
                        // dd(111);
                        $info['shop_price'] = $val['goods_price'];
                    }
                   
                    $info['buy_number'] = $val['buy_number'];
                    $info['goods_attr_id'] = $val['goods_attr_id'];
                    $info['goods_id'] = $val['goods_id'];
                    $info['seller_id'] = $val['seller_id'];
                    $info['order_id'] = $order_id;
                    $order_price = $order_price+$info['shop_price'];
                    // dd($order_price);
                    $order_shop_id[] = Order_goods::insertGetId($info);
                    if($order_shop_id){
                        Cart::where("rec_id",$val['rec_id'])->update(['is_del'=>2]);
                        if($val['goods_attr_id']){
                            $product = Products::where(["product_id"=>$val['product_id']])->decrement('product_number',$val['buy_number']);
                        }else{
                            $product = Goods::where(["goods_id"=>$val['goods_id']])->decrement('goods_number',$val['buy_number']);
                        }
                    }
              
                Order_info::where("order_id",$order_id)->update(["order_price"=>$order_price]);

                }

            }
        }
        DB::commit();
        } catch (Exception $e){
            DB::rollBack();   
            // dump($e->getMessage);
        }
            
        //    $price = Order_info::whereIn("order_id",$order_ids)->sum("order_price");
        //    dd($price);
            
            return $message = [
                "code"=>0002,
                "message"=>"添加成功",
                "success"=>true,
                "order_id"=>$order_ids,
                ];
    }
    public function createOrderSn(){
        $order_sn = date("Ymdhis").rand(1000,9999);
        if($this->isHaveOrdersn($order_sn)){
            $this->createOrderSn();
        }
        return $order_sn;
    }
    public function isHaveOrdersn($order_sn){
        return Order_info::where("order_sn",$order_sn)->count();
    }

}
