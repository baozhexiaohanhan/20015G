<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\Cart;
use App\Model\Goods_attr;
use App\Model\Order_info;
use App\Model\Order_goods;
use App\Model\Region;
use App\Model\Address;
use App\Model\Seckill;
use App\Model\Goods;
use DB;
class SeckillController extends Controller
{
    public function seckill(){
        $url = "http://www.2001api.com/seckill";
        $info = curl_get($url);
        // dd($info);
        $res = json_decode($info['data'],true);
        // dd($res);
        return view("index.seckill.seckill",compact("res"));
    }
    public function miaosha_shows(){
        $url = "http://www.2001api.com/miaosha_show?goods_id=".$goods_id."&seckill_id=".$seckill_id;

        $info = curl_get($url);
       
        // $goods_id = $info['goods_id'];
        // $goods_id2 = implode(" ",$goods_id);
        // trim($goods_id);
        // dd($info);
        if($info['goods_id']){
            $goods_id = json_decode($info['goods_id'],true);
            return redirect('/details/?goods_id='.$goods_id);
        }
      
    }
    public function miaosha_show(){
        
        $goods_id = request()->post("goods_id");
        $seckill_id = request()->post("seckill_id");
        // dd($seckill_id);
        $url = "http://www.2001api.com/miaosha_show?goods_id=".$goods_id."&seckill_id=".$seckill_id;

        $info = curl_get($url);
    //    1.秒杀结束后跳转到普通商品  2。未结束继续执行秒杀
        if(isset($info['goods_id'])){
            $goods_id = json_decode($info['goods_id'],true);
            return redirect('/details/?goods_id='.$goods_id);
        }
        if(isset($info['data'])){
            $data = json_decode($info['data'],true);
        }
    //    dd($data);
      
        return view("index.seckill.miaosha_show",compact("data"));
    }
   
    public function miaosha_show_add(){
       
        $goods_id = request()->goods_id;
        $goods_attr_id = request()->goods_attr_id;
        $buy_number = 1;
        // $a = request()->all();
        // dd($a);
        $user_id = Redis::hmget("admin",["user_id"]);
        // dd($user_id);
        $user_id = implode(",",$user_id);
        // return $rec_id;
        // $user_id = 0;
        $address = Address::where('user_id',$user_id)->get();
        // dd($address);
        $reg = new Region;
        foreach($address as $k=>$v){
            $address[$k]['country'] = $reg->where('region_id',$v->country)->value('region_name');
            $address[$k]['province'] = $reg->where('region_id',$v->province)->value('region_name');
            $address[$k]['city'] = $reg->where('region_id',$v->city)->value('region_name');
            $address[$k]['district'] = $reg->where('region_id',$v->district)->value('region_name');
            $address[$k]['tel'] = substr($v->tel,0,3)."****".substr($v->tel,7,4);
        }

        // $rec_id = explode(',',$request->rec_id);
        // $cart = Cart::select('cart.*','goods.goods_img')->leftjoin('goods','cart.goods_id','=','goods.goods_id')->whereIn('rec_id',$rec_id)->get();
        $goods = Seckill::leftjoin("goods","seckill.goods_id","=","goods.goods_id")->where("seckill.goods_id",$goods_id)->first();
        $goods['numbers'] = $buy_number;
        // dump($goods);

        $goods_attr_id = explode("|",$goods_attr_id);
        // dd($goods_attr_id);
        $attr_price = Goods_attr::whereIn("goods_attr_id",$goods_attr_id)->sum("attr_price");
        
        $goods_price = Seckill::where("goods_id",$goods_id)->first();

        $attr_goods = $goods_price['price']+$attr_price;
        $attr_goods = number_format($attr_goods,2,".","");
        // dd($attr_goods);
        return view("index.seckill.miaosha_show_add",compact("address","goods","attr_goods"));
    
    }
    public function seckill_order(){
         $data = request()->all();
        //  dd($data);
    $da = request()->all();
    $order_sn['order_sn'] = $this->createOrderSn();
    $order_sn = $order_sn['order_sn'];
   
    $user_id = Redis::hmget("admin",["user_id"]);
    // dd($user_id);
    $user_id = implode(",",$user_id);
    // dd($user_id);
    if($user_id==""){
        return redirect("/log");
    }
  
    // 地址
    $address = Address::where(["address_id"=>1,"user_id"=>$user_id])->first();
    // 支付方式
    $info = [1=>"微信",2=>"支付宝",3=>"货到付款"];
    $mode['pay_type'] =$info[$da['pay_type']];
    $mode = $mode['pay_type'];

     $seckill_id = $da['id'];
     $or = "order_".$user_id."_".$seckill_id;
    //  dump($or);
    $seckill = Seckill::where("id",$seckill_id)->first();
    $goods = Seckill::leftjoin("goods","seckill.goods_id","=","goods.goods_id")->where("id",$data['id'])->first();
    // dd($goods);
    Redis::hmset($or,
        "order_sn",$order_sn,
        "user_id",$user_id,
        "consignee",$address['address_name'],
        "country",$address['country'],
        "province",$address['province'],
        "city",$address['city'],
        "district",$address['district'],
        "address",$address['address'],
        "mobile",$address['tel'],
        "tel",$address['tel'],
        "order_price",$da['price'],
        "goods_price",$da['price'],
        "pay_type",$da['pay_type'],
        "pay_name",$mode,
        "seller_id",$da['seller_id'],
        "goods_name",$goods['goods_name'],
        "goods_id",$goods['goods_id'],
        "goods_sn",$goods['goods_sn'],
        "buy_number",1,
    );
    // Redis::exprie($or);
    // $res = Redis::hgetall($or);
    // Redis::del($or);dd(11);
    // dd($res);
    $order = $or;
    return $message = [
        "code"=>0002,
        "message"=>"添加成功",
        "success"=>true,
        "order"=>$order,
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
