<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods_attr extends Model
{
    // 指定表名
    protected $table = 'goods_attr';
    protected $primaryKey = 'goods_attr_id';
    // 关闭时间戳
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
