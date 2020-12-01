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
use Illuminate\Support\Facades\Redis;
class ShopcartController extends Controller
{
    public function shopcart(Request $request){
        $rec_id = request()->rec_id;
        // return $rec_id;
        $user_id = Redis::hmget("admin",["user_id"]);
        $user_id = implode(",",$user_id);
        // dd($user_id);

        $address = Address::where('user_id',29)->get();
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
        $cart = Cart::select('cart.*','goods.goods_img')->leftjoin('goods','cart.goods_id','=','goods.goods_id')->whereIn('rec_id',$rec_id)->get();
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

        $shop = [
            "region"=>$region,
        ];
        // dd($shop);
        $shop = json_encode($shop);
        $shop = ["ok","msg"=>$shop];
        return $shop;
    }
    public function address_up(){
        $callback = request()->callback;
        // $data = Brand::all();
        $address_id = request()->get("address_id");
         Address::update(['mo'=>0]);
        $res = Address::where("address_id",$address_id)->update(['mo'=>1]);
        if($res){
            
            $result = json_encode(['code'=>1,'msg'=>'ok','data'=>"ok"]);
            // echo $callback.'('.$result.')';
        }
       



    }
    

    
}
