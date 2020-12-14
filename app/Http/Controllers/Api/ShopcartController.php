<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Goods_attr;
use App\Model\Order_info;
use App\Model\Order_goods;
use App\Model\Region;
use App\Model\Address;
use DB;
use App\Model\Coupon;
use App\Model\Goods;
use App\Model\Products;
use App\Model\Order;
use Illuminate\Support\Facades\Redis;
class ShopcartController extends Controller
{
    public function shopcart(Request $request){
        $rec_id = request()->rec_id;
        // return $rec_id;
        $user_id = Redis::hmget("admin",["user_id"]);
        // dd($user_id);
        $user_id = implode(",",$user_id);
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

        $rec_id = explode(',',$request->rec_id);
        $cart = Cart::select('cart.*','goods.goods_img','coupon.name')->leftjoin('goods','cart.goods_id','=','goods.goods_id')->leftjoin("coupon","cart.goods_id","=","coupon.range")->whereIn('rec_id',$rec_id)->get();
        // return $cart;
        foreach($cart as $k=>$v){
            if($v->goods_attr_id){
                $goods_attr_id = explode('|',$v->goods_attr_id);
                $goods_attr = Goods_attr::select('attr_name','attr_value')->leftjoin('attr','goods_attr.attr_id','=','attr.attr_id')->whereIn('goods_attr_id',$goods_attr_id)->get();
                // dd($goods_attr);
                $cart[$k]['goods_attr'] = $goods_attr?$goods_attr->toArray():[];
            }
        }

    
        $rec_id = implode(',',$rec_id);

        $price = DB::select("select SUM(goods_price*buy_number) as total FROM cart where rec_id in($rec_id)" );
        
        // echo 123;exit;
        $price = $price[0]->total;
        


        $shop = [
            "cart"=>$cart,
            "rec_id"=>$rec_id,
            "address"=>$address,
            // "region"=>$region,
            "price"=>number_format($price,2,".",""),
            // "price"=>$price,
        ];
        // dd($shop);




        $shop = json_encode($shop);
        $shop = ["ok","msg"=>$shop];
        return $shop;
    }

    public function address(){

        $region = Region::where('parent_id',0)->get();

        $user_id = Redis::hmget("admin",["user_id"]);
        // dd($user_id);
        $user_id = implode(",",$user_id);
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

        $shop = [
            "region"=>$region,
            "address"=>$address,
        ];
        // dd($shop);
        $shop = json_encode($shop);
        $shop = ["ok","msg"=>$shop];
        return $shop;
    }
    public function address_up(){
         // return $rec_id;
         $user_id = Redis::hmget("admin",["user_id"]);
         // dd($user_id);
         $user_id = implode(",",$user_id);
        $callback = request()->callback;
        // $data = Brand::all();
        $address_id = request()->get("address_id");
        Address::where('user_id',$user_id)->update(['mo'=>1]);
        $res = Address::where(['user_id'=>$user_id,'address_id'=>$address_id])->update(['mo'=>2]);
        if($res){
            
            $result = json_encode(['code'=>1,'msg'=>'ok','data'=>"ok"]);
            echo $callback.'('.$result.')';
        }
    }
    public function order_add(){
        $callback = request()->callback;
        

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
                            $info['shop_price'] = $val['goods_price']*$val['buy_number']-$val['type_ext'];

                        }else if($val['goods_price']>300){
                            $info['shop_price'] = $val['goods_price']*$val['buy_number'];-$val['type_ext'];

                        }
                    }else{
                        $info['shop_price'] = $val['goods_price']*$val['buy_number'];
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
                        Cart::where("rec_id",$val['rec_id'])->update(['is_del'=>1]);
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
            if(count($order_ids)>1){
                $prices = Order_info::whereIn("order_id",$order_ids)->sum("order_price");
                $danhao = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
                $infos = [
                    "user_id"=>$user_id,
                    "order_sn"=>$danhao,
                    "order_price"=>$prices,
                    "addtime"=>time()
                ];
                $or_id = Order::insertGetId($infos);
                foreach($order_ids as $k=>$v){
                    $res = Order_info::where("order_id",$v)->update(["or_id"=>$or_id]);
                }
                // return $message = [
                //     "code"=>1003,
                //     "message"=>"添加成功",
                //     "success"=>true,
                //     "or_id"=>,
                //     ];
                $result = json_encode(['code'=>1003,'msg'=>'ok','or_id'=>$or_id]);
                echo $callback.'('.$result.')';
            }
        //    dd(11);
            // return $message = [
            //     "code"=>0002,
            //     "message"=>"添加成功",
            //     "success"=>true,
            //     "order_id"=>$order_ids,
            //     ];
            $result = json_encode(['code'=>0002,'msg'=>'ok','order_id'=>$order_id]);
            
            echo $callback.'('.$result.')';
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
