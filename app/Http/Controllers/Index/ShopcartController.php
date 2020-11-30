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

    public function address_do(Request $request){
        // $rec_id = request()->post("rec_id");
        $post = $request->except('_token');
        // dd($post);
        $res = Address::insert($post);
        if($res){
            return  redirect('/shopcart');
        }
    }

    //生成订单 and  订单商品
    public function order(Request $request){
        $datas = $request->all();
        // $data=request()->all();
        dd($datas);
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
        $order_id = request()->order_id;
        // $order_id = 4;
        
        $config = config("alipay");
        require_once app_path('Common/alipay/pagepay/service/AlipayTradeService.php');
        require_once app_path('Common/alipay/pagepay/buildermodel/AlipayTradePagePayContentBuilder.php');
            //使用SQL查询订单信息
            $order = Order_info::where("order_id",$order_id)->first();
            // dd($order);
            //商户订单号，商户网站订单系统中唯一订单号，必填
            $out_trade_no = $order['order_sn'];
        
            //订单名称，必填
            $order_name = Order_goods::where("order_id",$order_id)->pluck("goods_name")->toArray();
            // dd($order_name);
            $subject = implode("\r\n",$order_name);
        
            //付款金额，必填
            $total_amount = $order['order_price'];
        
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
        $aop = new \AlipayTradeService($config);
        $result = $aop->check($arr);
        $count = Order_info::where(['order_sn'=>$arr['out_trade_no'],"order_price"=>$arr['total_amount']])->count();

                /* 实际验证过程建议商户添加以下校验。
        1、商户需要验证该通知数据中的out_trade_no是否为商户系统中创建的订单号，
        2、判断total_amount是否确实为该订单的实际金额（即商户订单创建时的金额），
        3、校验通知中的seller_id（或者seller_email) 是否为out_trade_no这笔单据的对应的操作方（有的时候，一个商户可能有多个seller_id/seller_email）
        4、验证app_id是否为该商户本身。
        */
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
            $data = [
                "order_status"=>1,
                "pay_status"=>1,
            ];
            $update = Order_info::where(['order_sn'=>$arr['out_trade_no']])->update($data);
            if($update){
                return redirect("/home");
            }else{
                return "修改失败";
            }
        }
        else {
            //验证失败
            echo "验证失败";
        }
      
       
    }
    //订单商品 订单 数据入库order info goods
    public function order_add(){
        // $a = request()->all();
        // dd($a);
        // if($a==)
        // DB::beginTransaction();
        // try {
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
        $address = Address::where(["address_id"=>2,"user_id"=>$user_id])->first();
        // dd($address);
        // 支付方式
        $info = [1=>"微信",2=>"支付宝",3=>"货到付款"];
        $mode['pay_type'] =$info[$da['pay_type']];
        $mode = $mode['pay_type'];
        // 总价价格
        $rec_id = $da['rec_id'];
        $rec_id = implode(",",$rec_id);
        $order_price = \DB::select("select sum(goods_price*buy_number) as tot from cart where rec_id in($rec_id) ");

        $order_price = $order_price[0]->tot;
        // if($order_price > 100){
        //     $aa = rand(1,10);
        //     $bb = $aa/100;
        //     $price = $order_price*$bb; 
        //     // dd($price);
        // }
        // $order_price = $order_price-$price;
        // dd($order_price);
        $data = [
            "order_sn"=>$order_sn,
            "user_id"=>$user_id,
            "consignee"=>$address['address_name'],
            "country"=>$address['country'],
            "province"=>$address['province'],
            "city"=>$address['city'],
            "district"=>$address['district'],
            "address"=>$address['address'],
            "mobile"=>$address['tel'],
            "tel"=>$address['tel'],
            "best_time"=>0,
            "sign_building"=>0,
            "pay_name"=>$mode,
            "pay_type"=>$da['pay_type'],
            "order_price"=>$order_price,
            "goods_price"=>$order_price,
            "addtime"=>time(),
            "seller_id"=>$da['seller_id'],
        ];
        // dd($data);
        // 订单表入库
       $order_id = Order_info::insertGetId($data);
   
        $cary = Cart::whereIn("rec_id",$da['rec_id'])->get();
        $cary = $cary?$cary->toArray():[];
        // $order_id = 1;
        foreach($cary as $k=>$v){
            // dd($v);
            $cary[$k]["order_id"] = $order_id;
            $cary[$k]['shop_price'] = $v['goods_price'];
            $goods = Goods::find($v['goods_id']);
            $cary[$k]['goods_name'] =$goods['goods_name'];
            Cart::where("rec_id",$cary[$k]['rec_id'])->update(['is_del'=>2]);
            $goods_attr_id = $cary[$k]['goods_attr_id'];
            unset($cary[$k]['goods_price']);
            unset($cary[$k]['rec_id']);
            unset($cary[$k]['is_del']);
            unset($cary[$k]['seller_id']);
            unset($cary[$k]['add_time']);
            unset($cary[$k]['goods_totall']);
            unset($cary[$k]['user_id']);
        }
        
        // dd($cary);
        // 订单商品
        $res = Order_goods::insert($cary);
        // dd($res);
        // 提交订单 进行减库存 判断有无规格 对货品表  或 商品表进行减库存
        if($res){
          if($goods_attr_id){
            foreach($cary as $k=>$v){
                $product_id = $v['product_id'];
                $product = Products::where("product_id",$product_id)->first();
                $buy = $product['product_number']-$cary[$k]['buy_number'];
                $product = Products::where(["product_id"=>$cary[$k]['product_id']])->update(['product_number'=>$buy]);
            }
          }else{
            foreach($cary as $k=>$v){
                $goods_id = $v['goods_id'];
                $goods = Goods::where("goods_id",$goods_id)->first();
                $buy = $goods['goods_store']-$v['buy_number'];
                $product = Goods::where(["goods_id"=>$goods_id])->update(['goods_store'=>$buy]);
            }
          }
        }
            // DB::commit();
            return $message = [
                "code"=>0002,
                "message"=>"添加成功",
                "success"=>true,
                "order_id"=>$order_id,
                ];
        // } catch (Exception $e){
            // DB::rollBack();
            // dump($e->getMessage);
        // }
        // dd($res);
        
       
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
