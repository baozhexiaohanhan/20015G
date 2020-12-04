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
        // $data = request()->all();
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
    // $rec_id = $da['rec_id'];
    // $rec_id = implode(",",$rec_id);
    $order_price = $da['price'];
     //\DB::select("select sum(goods_price*buy_number) as tot from cart where rec_id in($rec_id) ");
    //  Redis::hmset("order".$user_id,[]);
    // $order_price = $order_price[0]->tot;
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
        "seckill"=>2,
    ];
    // Redis::hmset("order","order_sn",$order_sn,"user_id",$user_id,"address_id",2,"order_price",$order_price);
    // $order = Redis::hmget("order",["order_sn","user_id","address_id","order_price"]);

    // dd($order);
    // 订单表入库
   $order_id = Order_info::insertGetId($data);
//    $order_id = 1;
    $seckill = Seckill::where("id",$da['id'])->first();
    // dd($seckill);
    // $cary = $cary?$cary->toArray():[];
    // // $order_id = 1;
    // foreach($cary as $k=>$v){
    //     // dd($v);
    //     $cary[$k]["order_id"] = $order_id;
    //     $cary[$k]['price'] = $v['price'];
    //     $goods = Goods::find($v['goods_id']);
    //     $cary[$k]['goods_name'] =$goods['goods_name'];

        // $goods_attr_id = $cary[$k]['goods_attr_id'];
        // unset($cary[$k]['goods_price']);
        // unset($cary[$k]['rec_id']);
        // unset($cary[$k]['is_del']);
        // unset($cary[$k]['seller_id']);
        // unset($cary[$k]['add_time']);
        // unset($cary[$k]['goods_totall']);
        // unset($cary[$k]['user_id']);
    // }
    $goods_sn = rand(99999,10000);
    $order_goods = [
        "order_id"=>$order_id,
        "goods_id"=>$seckill['goods_id'],
        "goods_sn"=>$goods_sn,
        "product_id"=>20,
        "goods_name"=>$seckill['name'],
        "shop_price"=>$seckill['price'],
        "buy_number"=>1,
        "goods_attr_id"=>"106|108|110",
    ];
    // dd($order_goods);
    // 订单商品
    $res = Order_goods::insert($order_goods);
    // dd($res);
    // 提交订单 进行减库存 判断有无规格 对货品表  或 商品表进行减库存
    // if($res){
    //   if($goods_attr_id){
    //     foreach($cary as $k=>$v){
    //         $product_id = $v['product_id'];
    //         $product = Products::where("product_id",$product_id)->first();
    //         $buy = $product['product_number']-$cary[$k]['buy_number'];
    //         $product = Products::where(["product_id"=>$cary[$k]['product_id']])->update(['product_number'=>$buy]);
    //     }
    //   }else{
    //     foreach($cary as $k=>$v){
    //         $goods_id = $v['goods_id'];
    //         $goods = Goods::where("goods_id",$goods_id)->first();
    //         $buy = $goods['goods_store']-$v['buy_number'];
    //         $product = Goods::where(["goods_id"=>$goods_id])->update(['goods_store'=>$buy]);
    //     }
    //   }
    // }
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
        // dd($data);
        // return view("index.seckill.seckill_order");
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
