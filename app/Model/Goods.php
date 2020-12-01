<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    // 指定表名
    protected $table = 'goods';
    protected $primaryKey = 'goods_id';
    // 关闭时间戳
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
    public function getslice(){
   		$slice=self::select('goods_img','goods_id')->where('is_slice',1)->where('seller_id',1)->where('is_up',1)->get();
    	return $slice;
   }
}
