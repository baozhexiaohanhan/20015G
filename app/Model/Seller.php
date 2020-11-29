<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
   // 指定表名
   protected $table = 'seller';
   protected $primaryKey = 'seller_id';
   // 关闭时间戳
   public $timestamps = false;
   // 黑名单
   protected $guarded = [];
}
