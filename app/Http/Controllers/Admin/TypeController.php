<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods_type;
class TypeController extends Controller
{
    public function Type(){
        return view("admin.type.type");
    }
    public function type_add(){
        $da = request()->all();
        $res = Goods_type::insert($da);
        return json_encode(['code'=>100,"msg"=>"成功"]);
    }
    public function type_index(){
        $res = Goods_type::where("is_del",1)->get();
        return view("admin.type.type_index",compact("res"));
    }
    public function type_del(){
        $info = request()->all();
        $res = Goods_type::where("cat_id",$info)->update(['is_del'=>2]);
        if($res){
            return json_encode(['code'=>100,"msg"=>"成功"]);
        }
    }
    public function ajaxjdjd(){
        
    }
}
