<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Attr;
use App\Model\Goods_type;
class AttrsController extends Controller
{
    public function attr($cat_id){
        $res = Goods_type::get();
        return view("admin.attrs.attr",compact("res","cat_id"));
    }
    public function attr_add(){
        $da = request()->all();
        // dd($da);
        $res = Attr::insert($da);
        if($res){
            return redirect("/type_index");
        }
    }
    public function attr_index($id){
        $res = Attr::where("attr.cat_id",$id)->where("attr.is_del",1)->leftjoin("goods_type","attr.cat_id","=","goods_type.cat_id")->get();
        // dd($res);
        // $cat_id = Goods_type::select("cat_id")->find($id);
        // dd($cat_id);
        return view("admin.attrs.attr_index",compact("res","id"));
    }
    public function attr_del(){
        $attr_id = request()->attr_id;
        // dd($attr_id);
        $res = Attr::where("attr_id",$attr_id)->update(['is_del'=>2]);
        if($res){
            return json_encode(['code'=>100,"msg"=>"成功"]);
        }
    }
}
