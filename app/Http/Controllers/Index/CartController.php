<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Goods_attr;
use App\Model\Goods;
use App\Model\Products;

class CartController extends Controller
{
    public function index(){
    	$user=1;
    	//两表联查  cart.*查询购物车所有
    	$cart=Cart::select('cart.*','goods.goods_img','goods.goods_name','goods.is_up')
    		->leftjoin('goods','cart.goods_id','=','goods.goods_id')
    		->where('user_id',$user)->get();
    		// dd($cart);
    		foreach ($cart as $k=>$v) {
    			if($v->goods_attr_id){
    				$goods_attr_id=explode('|',$v->goods_attr_id);
    				// dd($goods_attr_id);
    				$goods_attr=Goods_attr::select('attr_name','attr_value')
    						->leftjoin('attr','goods_attr.attr_id','=','attr.attr_id')
    						->whereIn('goods_attr_id',$goods_attr_id)
    						->get();
    						// dd($goods_attr);
    				$cart[$k]['goods_attr']=$goods_attr?$goods_attr->toArray():[];
    				
    			}
    		}
    		// dd($cart);



    	return view('index.cart.cart',['cart'=>$cart]);
    }
    public function getcartprice(){
    	$cart_id=request()->cart_id;
    	// dd($cart_id);
    	if(!$cart_id){
            return $this->success('ok',['total'=>'0.00']);
        }
        $total=Cart::getprice($cart_id);
        // dd($total);
        return $this->success('ok',['total'=>$total]);
    }
    public function cartplus(){
    	$user=1;
    	$data=request()->all();
    	// dd($data);
    	$buy_number=$data['buy_number'];
    	// dd($buy_number);
    	$rec_id=$data['rec_id'];
    	$goods_attr_id=$data['goods_attr_id'];
    	// dd($goods_attr_id);
    	$goods_id=$data['goods_id'];
    	$goods=Goods::find($goods_id);
    	// dd($goods_id);
    	if($goods_attr_id){
    		// dd(123);
            if($goods->goods_number<$buy_number){

            $buy_number = $goods->goods_number;
            // dd($buy_number);
            Cart::where(["rec_id"=>$rec_id,"user_id"=>$user,"goods_id"=>$goods_id])->update(['buy_number'=>$buy_number]);
                 return $message = [
                    "code"=>0001,
                    "msg"=>"数量",
                    "data"=>$buy_number,
                ];
         	}
        }
        Cart::where(["rec_id"=>$rec_id,"user_id"=>$user,"goods_id"=>$goods_id])->update(['buy_number'=>$buy_number]);

        Cart::where(["user_id"=>$user,"goods_attr_id"=>$goods_attr_id,"goods_id"=>$goods_id])->update(['buy_number'=>$buy_number]);
        
        $info = Cart::where(['user_id'=>$user,"rec_id"=>$rec_id])->first();
      	//dd($info);
       
        $price = $info['buy_number']*$info['shop_price'];
        if($price){
            return $message = [
                "code"=>0000,
                "msg"=>"价格",
                "data"=>$price,
            ];
        }
    }
}
