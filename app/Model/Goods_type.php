<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods_type extends Model
{
     // 指定表名
    protected $table = 'goods_type';
    protected $primaryKey = 'cat_id';
    // 关闭时间戳
    public $timestamps = false;
    // 黑名单
    protected $guarded = [];
}
