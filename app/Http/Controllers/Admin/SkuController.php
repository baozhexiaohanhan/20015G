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
use App\Model\Goods_attr;
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
        $data = request()->except(["_token","file"]);
        
        // dump($data);
         // 商品表
        $goods_sn = $this->goods_sn();
        $goods = [
            "goods_name" => $data['goods_name'],
            "cate_id" => $data['cate_id'],
            "brand_id" => $data['brand_id'],
            "goods_price" => $data['goods_price'],
            "goods_number" => $data['goods_store'],
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
       

       $attr_id_list = request()->attr_id_list;
        $attr_value_list = request()->attr_value_list;
        $attr_price_list = request()->attr_price_list;
    //    商品属性表
        if(count($attr_id_list) && count($attr_value_list)){
            $goods_attr = [];
            for ($i=0; $i <count($attr_id_list) ; $i++) { 
                $goods_attr[] = [
                    "goods_id"=>$goods_id,
                    "attr_id"=>$attr_id_list[$i],
                    "attr_value"=>$attr_value_list[$i],
                    "attr_price"=>$attr_price_list[$i],
                ];
                // dd($goods_attr);
            }
        $res =  Goods_attr::insert($goods_attr);

        // 货品表展示
        // $goods_id = 22;
        $goods_specs = $this->GoodsSpecs($goods_id);
        // dump($goods_specs);
        if(count($goods_specs)){
            $new_goods_specs = [];

            foreach($goods_specs as $k=>$v){
                $new_goods_specs['attr_name'][$v['attr_id']]=$v['attr_name'];
                $new_goods_specs['attr_values'][$v['attr_id']][$v['goods_attr_id']] = $v['attr_value'];
                // dd($v);
            }
           
        }
        $go = Goods::where("goods_id",$goods_id)->first();

            dump($new_goods_specs);

        return view("admin.sku.product",compact("new_goods_specs","go"));

        }
    }
    // 货品入库
    public function product_add(){
        $da = request()->except(['_token']);
        
        if(count($da['attr'])){
            $data = $da['attr'];
            $datakey = array_key_first($data);
            $count = count($data[$datakey]);
            for($i=0;$i<$count;$i++){
                $new_attr[] = array_column($data ,$i);

            }
            $product = [];
            foreach($new_attr as $k=>$v){
                $product[] = [
                    "goods_id"=>$da['goods_id'],
                    "goods_attr"=>implode('|',$v),
                    "product_sn"=>$da['product_sn'][$k],
                    "product_number"=>$da['product_number'][$k],
                ];
            }
            // dd($product);
          $pro = Products::insert($product);
            if($pro){
                return redirect("/sku");
            }else{
                echo "添加失败";
            }
        }
    }
    public function GoodsSpecs($goods_id){
        $goodsSpecs = Goods_attr::select("goods_attr_id","goods_attr.attr_id","attr.attr_name","goods_attr.attr_value")->leftjoin("attr","goods_attr.attr_id","=","attr.attr_id")->where(["goods_id"=>$goods_id,"attr_type"=>1])->get();
        return $goodsSpecs;
    }

    // 商品编号
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

    public function product_index(){
        $data = Goods::get();
        return view("admin.sku.product_index",compact("data"));
    }

    public function item_show($goods_id){
        // dd($goods_id);
        $goods = Goods::find($goods_id);
        $attrs  = Goods_attr::select("goods_attr_id","goods_attr.attr_id","attr.attr_name","goods_attr.attr_value")->leftjoin("attr","goods_attr.attr_id","=","attr.attr_id")->where(["goods_id"=>$goods_id,"attr.attr_type"=>1])->get();
        // dd($attrs);
         if($attrs){
             $attrs_new_key = [];
            foreach($attrs as $k=>$v){
            $attrs_new_key[$v['attr_id']]['attr_name'] = $v['attr_name'];
            $attrs_new_key[$v['attr_id']]['attr_value'][$v['goods_attr_id']] = $v['attr_value'];
            }
         }
        //  dump($attrs_new_key);
        return view("admin.sku.item_show",compact("attrs_new_key","goods"));
    }
    public function attr_key(){
        $data = request()->all();
        $attr_price = Goods_attr::whereIn("goods_attr_id",$data['goods_attr_id'])->sum("attr_price");
        $goods_price = Goods::where("goods_id",$data['goods_id'])->first();

        $attr_goods = $goods_price['goods_price']+$attr_price;
        $attr_goods = number_format($attr_goods,2,".","");
        // dd($attr_goods);

        return json_encode(['code'=>0001,"msg"=>"成功","data"=>$attr_goods]);
    }

}
