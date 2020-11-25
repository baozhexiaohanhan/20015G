<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_goods extends Model
{
    // 指定表名
    protected $table = 'order_goods';
    protected $primaryKey = 'order_shop_id';
    // 关闭时间戳
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
