<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Goods_attr;
use App\Model\Order_info;
use App\Model\Order_goods;
class ShopcartController extends Controller
{
    public function shopcart(Request $request){
        $rec_id = request()->rec_id;
        // dd($rec_id);
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

        $cartData = CartModel::select('ecs_goods.goods_id','ecs_goods.goods_name','ecs_goods.shop_price','ecs_goods.goods_thumb','ecs_cart.buy_number')
                    ->leftjoin('ecs_goods','ecs_cart.goods_id','=','ecs_goods.goods_id')
                    ->where(['user_id'=>$user,'is_on_sale'=>1])
                    ->whereIn('ecs_cart.cart_id',$cart_id)
                    ->get();
         $price = DB::select("select SUM(shop_price*buy_number) as total FROM ecs_cart");
        //   var_dump($price);exit;
        
        $rec_id = implode(',',$rec_id);
        $shop = [
            "cart"=>$cart,
            "rec_id"=>$rec_id,
        ];
        // dd($shop);




        $shop = json_encode($shop);
        $shop = ["ok","msg"=>$shop];
        return $shop;
    }
    
}
