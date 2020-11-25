<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order_info extends Model
{
    // 指定表名
    protected $table = 'order_info';
    protected $primaryKey = 'order_id';
    // 关闭时间戳
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
