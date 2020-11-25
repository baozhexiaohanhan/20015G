<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Goods_attr;
use App\Model\Order_info;
use App\Model\Order_goods;
use DB;
class ShopcartController extends Controller
{
    public function shopcart(Request $request){
        $rec_id = request()->rec_id;
        // return $rec_id;

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

        // $cartData = Cart::select('goods.goods_id','goods.goods_name','goods.goods_price','cart.buy_number')
        //             ->leftjoin('goods','cart.goods_id','=','goods.goods_id')
        //             ->whereIn('cart.rec_id',$rec_id)
        //             ->get();
        $rec_id = implode(',',$rec_id);

        $price = DB::select("select SUM(goods_price*buy_number) as total FROM cart where rec_id in($rec_id)" );
        
        // echo 123;exit;
        $price = $price[0]->total;
        // $price= ;
        // return $price;

        // $count = count($cartData);


        $shop = [
            "cart"=>$cart,
            "rec_id"=>$rec_id,
            // "count"=>$count,
            "price"=>number_format($price,2,".",""),
            // "price"=>$price,
        ];
        // dd($shop);




        $shop = json_encode($shop);
        $shop = ["ok","msg"=>$shop];
        return $shop;
    }
    
}
