<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Order_info;
use App\Model\Order_goods;
class ShopcartController extends Controller
{
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

}
