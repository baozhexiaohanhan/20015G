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
    //加入购物车
    /**
     * 加入购物车
     * 1.判断用户是否登录 未登录跳转到登录页面
     * 2.判断商品id、购买数量，未传递提示 缺少参数
     * 3.根据商品id 查询商品是否上下架 下架提示 商品已下架
     * 4.判断规格是否存在，有：查询product的库存 购买数量大于库存提示 库存不足 没有规格查询goods的库存 购买数量大于库存提示 库存不足
     * 5.根据当前用户人id，商品id和规格判断购物车内是否有此商品 没有添加入库 有 更新购买数量，购买数量大于库存提示，把购买数量改为最大库存 更新
     * 
     */
    public function addcart(Request $request){
        $data = $request->all();
        $url = "http://www.2001api.com/addcart";
        $cart = curl_post($url,$data);
        $cart = json_decode($cart['data'],true);
    }
    public function index(Request $request){
        // $user=1;
        // //两表联查  cart.*查询购物车所有
        // $cart=Cart::select('cart.*','goods.goods_img','goods.goods_name','goods.is_up')
        //     ->leftjoin('goods','cart.goods_id','=','goods.goods_id')
        //     ->where('user_id',$user)->get();
        //     // dd($cart);
        //     foreach ($cart as $k=>$v) {
        //         if($v->goods_attr_id){
        //             $goods_attr_id=explode('|',$v->goods_attr_id);
        //             // dd($goods_attr_id);
        //             $goods_attr=Goods_attr::select('attr_name','attr_value')
        //                     ->leftjoin('attr','goods_attr.attr_id','=','attr.attr_id')
        //                     ->whereIn('goods_attr_id',$goods_attr_id)
        //                     ->get();
        //                     // dd($goods_attr);
        //             $cart[$k]['goods_attr']=$goods_attr?$goods_attr->toArray():[];
                    
        //         }
        //     }
        //     // dd($cart);
        // $data = $request->all();
        // dd($data);
        $url = "http://www.2001api.com/index";
        // dd($url);
        $cart = curl_get($url);
        // dd($cart);

        $cart = json_decode($cart['data'],true);
        // dd($cart);

        return view('index.cart.cart',['cart'=>$cart]);
    }
   public function getcartprice(Request $request){
        $data = $request->all();
        $url = "http://www.2001api.com/getcartprice";
        $total = curl_post($url,$data);
         // dd($total);
        $total = json_decode($total['data'],true);
    }
    public function cartplus(Request $request){
        $data = $request->all();
        // dd($data);
        $url = "http://www.2001api.com/cartplus";
        $price = curl_post($url,$data);
        // dd($price);

        $price = json_decode($price['data'],true);

        return $price;
    }
    //删除
    public function destroy($id=0){
       $res=Cart::where('rec_id',$id)->update(['is_del'=>1]);
       // dd($res);
        
       if($res){
            return response()->json(['code'=>0,'msg'=>'删除成功!']);
        }
        if($res){
            return redirect('/cart');
        }
    }
    //全删除
    public function destroys(){
        // dd($id);
        $id=request()->ids;
        // dd($id);
        if(!$id){
            return;
        }
       $res=Cart::whereIn('rec_id',$id)->update(['is_del'=>1]);
       // dd($res);
        
       if($res){
            return response()->json(['code'=>0,'msg'=>'删除成功!']);
        }
        if($res){
            return redirect('/cart');
        }
    }
}
