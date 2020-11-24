<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table="cart";
    protected $primaryKey="rec_id";
    public $timestamps=false;
    protected $guarded=[];
    public static function getprice($cart_id){

        //dd($cart_id);
         // $cart_id=explode(',',$cart_id);
         // unset($cart_id[0]);
    	if(is_array($cart_id)){
    		$cart_id=implode(',',$cart_id);    
    	}
    	$cart_id = trim($cart_id,',');
    	$total=\DB::select("select sum(goods_price*buy_number) as total from cart where rec_id in($cart_id)");
	    $total=$total?$total[0]->total:0;
	    return $total;
    }
}
