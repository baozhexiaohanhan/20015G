<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cate;
use App\Model\BrandModel;
use App\Model\Goods_type;
use App\Model\Attr;
use App\Model\Goods_log;
use App\Model\Goods;
use App\Model\Products;

class SkuController extends Controller
{
    public function Sku(){
        $data = Cate::get();
        $data=self::list_level($data->toArray());
        $brand_data = BrandModel::get();
        $type = Goods_type::get();
        // dd($type);
        return view("admin.sku.sku",compact("data","brand_data","type"));
    }
    //无限极分类
    public static function list_level($data,$pid=0,$level=0)//三个参数与上面index方法里面穿的参数相对应
    {
//        dd($data);
        static $array=[];
        foreach($data as $k=>$v){
            if($pid==$v['pid']){
                $v['level']=$level;
                $array[]=$v;
                self::list_level($data,$v['cate_id'],$level+1);
            }
        }
//        dd($array);
        return $array;
   }
    // 单图片
    public function uploads(Request  $request){
        $file = $request->file;
        // dump(11);
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
        $photo = $request->file;
        $extension = $photo->extension();
        $store_result = $photo->store('upload');
        
        // $store_result = $photo->storeAs('photo', 'test.jpg');
        $data = env('UPLOAD_URL').'/'.$store_result;
        // dd($data);
        return json_encode(['code'=>1,"message"=>"上传成功","data"=>$data]);
        // print_r($data);exit();
                // dd($);
        }
    }
    public function goods_imgdo(Request  $request){
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = request()->file;
            $store_result = $photo->store('uploads');
            $data = env('UPLOAD_URL').'/' . $store_result;
            // dd($data);
            return json_encode(['code' => 0, 'msg' => '上传成功', 'result' => $data]);
        }
        return json_encode(['code'=>1,'msg'=>'上传失败']);
    }

    public function store(){
       
        // ,"cat_id","goods_imgs","cat_id","attr_id_list","attr_value_list","attr_price_list",""
        $data = request()->except(["_token","file","goods_sn"]);
        dump($data);
         // 商品表
        $goods_sn = $this->goods_sn();
        $goods = [
            "goods_name" => $data['goods_name'],
            "cate_id" => $data['cate_id'],
            "brand_id" => $data['brand_id'],
            "goods_price" => $data['goods_price'],
            "goods_store" => $data['goods_store'],
            "goods_img" => $data['goods_img'],
            "goods_sn" => $goods_sn,
            "goods_desc" => $data['editorValue'],
            "is_show" => $data['is_show'],
            "is_hot" => $data['is_hot'],
            "is_up" => $data['is_up'],
            "is_new" => $data['is_new'],
            "add_time" => time(),
        ];
       $goods_id = Goods::insertGetId($goods);

        // 商品相册
        $goods_img = $data['goods_imgs'];
        $goods_log = implode("|",$goods_img);
        $log = [
            "goods_id" => $goods_id,
            "goods_log" => $goods_log
        ];
       $img = Goods_log::insert($log);
        // dd($goods_log);
    }
    public function goods_sn(){
        $id = rand(100,999);
        $sn = date('YmdHis', time()); 
        $sn = substr($sn, -2); 
        $sn.= date('m', time()); 
        $sn.=sprintf("%04d", $id);
        return $sn;
    }

    // 属性
    public function type_attr(){
        $cat_id = request()->cat_id;

        $data = Attr::where("cat_id",$cat_id)->get();
        // dd($data);

        return view("admin.sku.type_attr",compact("data"));
    }


}
