<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cart;
use App\Model\Goods_attr;
use App\Model\Goods;
use App\Model\Products;

class CartController extends Controller
{
	public function addcart(Request $request){
        // dd($request->all());
        // $goods_id = $request->goods_id;
        // dd($goods_id);
        $user_id=1;
        // dd($user_id);
        if(!$user_id){
            $this->error('未登录');
        }
        // 2.判断商品id、购买数量，未传递提示 缺少参数
        $goods_id=$request->goods_id;
        $buy_number=$request->buy_number;
        // dd($buy_number);
        $goods_attr_id=$request->goods_attr_id;
        if(!$goods_id || !$buy_number){
            return $this->JsonResponse('1003','缺少参数');
        }

        // 3.根据商品id 查询商品是否上下架 下架提示 商品已下架
        $goods=Goods::select('goods_id','goods_name','goods_sn','goods_price','is_up','goods_number')->find($goods_id);
        

        if($goods->is_up=='2'){
             return $this->JsonResponse('1004','商品已下架');
        }


        // 4.判断规格是否存在，有：查询product的库存 购买数量大于库存提示 库存不足 没有规格查询goods的库存 购买数量大于库存提示 库存不足
        if($goods_attr_id){
            $goods_attr_id=implode('|',$goods_attr_id);
            //走规格查询
            $product=Products::select('product_id','product_number')->where(['goods_id'=>$goods_id,'goods_attr'=>$goods_attr_id])->first();
            // dd($product);
            // dd($product->product_number);
           if($product->product_number<$buy_number){
                 return $this->JsonResponse('1005','商品库存不足');
            }
        }else{
            if($goods->goods_number<$buy_number){
                 return $this->JsonResponse('1005','商品库存不足');
            }
        }
        
            // 5.根据当前用户人id，商品id和规格判断购物车内是否有此商品 没有添加入库 有 更新购买数量，购买数量大于库存提示，把购买数量改为最大库存 更新
            $cart=Cart::where(['user_id'=>$user_id,'goods_id'=>$goods_id,'goods_attr_id'=>$goods_attr_id])->first();
            if($cart){
                //更新购买数量
                $buy_number=$cart->buy_number+$buy_number;
                // dd($buy_number);
                if($goods_attr_id){
                    //走规格查询
                    if($product->product_number<$buy_number){
                        $buy_number=$product->product_number;
                    }
                }else{
                    if($goods->goods_number<$buy_number){
                        $buy_number=$goods->goods_number;
                    }
                }
                $res=Cart::where('rec_id',$cart->rec_id)->update(['buy_number'=>$buy_number]);
                // dd($res);
            }else{
                //添加购物车
                $data=[
                    'user_id'=>$user_id,
                    'product_id'=>$product->product_id??0,
                    'buy_number'=>$buy_number,
                    'goods_attr_id'=>$goods_attr_id??''
                ];
                // dd($data);
                $goods=$goods?$goods->toArray():[];
                unset($goods['is_up']);
                unset($goods['goods_number']);
               $data=array_merge($data,$goods);
               $res=Cart::insert($data);
               // dd($res);
            }
            if($res){
                 return $this->success('加入购物车成功');
               }
    }

    public function index(){
    	$user=1;
    	// dd($user);
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
    		$cart=[
    			'user'=>$user,
    			'cart'=>$cart,
    			'goods_attr_id'=>$goods_attr_id,
    			'goods_attr'=>$goods_attr
    		];

    	$cart = json_encode($cart);
        $cart = ["ok","data"=>$cart];
        // dd($cart);
        return $cart; 
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
                    "code"=>10001,
                    "msg"=>"数量",
                    "data"=>$buy_number,
                ];
         	}
        }
        Cart::where(["rec_id"=>$rec_id,"user_id"=>$user,"goods_id"=>$goods_id])->update(['buy_number'=>$buy_number]);

        Cart::where(["user_id"=>$user,"goods_attr_id"=>$goods_attr_id,"goods_id"=>$goods_id])->update(['buy_number'=>$buy_number]);
        
        $info = Cart::where(['user_id'=>$user,"rec_id"=>$rec_id])->first();
      	//dd($info);
       
        $price = $info['buy_number']*$info['goods_price'];
        if($price){
            return $message = [
                "code"=>10000,
                "msg"=>"价格",
                "data"=>$price,
            ];
        }
    }
}
