<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Cate;
use App\Model\BrandModel;

class SkuController extends Controller
{
    public function Sku(){
        $data = Cate::get();
        $data=self::list_level($data->toArray());
        $brand_data = BrandModel::get();
        // dd($data);
        return view("admin.sku.sku",compact("data","brand_data"));
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
        $data = request()->all();
        dd($data);
    }

}
