<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Goods_attr;

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
