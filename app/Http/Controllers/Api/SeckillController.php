<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;
use App\Model\Seckill;
class SeckillController extends Controller
{
    public function seckill(){
        $info = Seckill::leftjoin("goods","seckill.goods_id","=","goods.goods_id")->where(['seckill.is_del'=>1,"goods.is_up"=>1])->paginate(12);
        $info = json_encode($info);
        $data = ["ok","data"=>$info];
        // dd($data);
        return $data;
    }
}
