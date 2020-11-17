<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class cateController extends Controller
{
    //分类展示页面
    public function cateindex()
    {
        $res = DB::table('cate')->get();
//        dd($res);
        return view('admin/cate/cateindex',['res'=>$res]);
    }
//    添加
    public  function cateadd()
    {
        $data = DB::table('cate')->get();
        return view('admin/cate/cateadd',['data'=>$data]);
    }
//    添加执行
    public  function do_cateadd(request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('cate')->insert([
            'cate_name' => $data['cate_name'],
            'pid'=>$data['pid'],
            'cate_show'=>$data['cate_show'],
            'cate_new_show'=>$data['cate_new_show']
        ]);
        if($res){
            echo "<script>alert('添加成功,跳转至列表页');location.href='/cate/cateindex';</script>";
        }else{
            echo "<script>alert('添加失败,请重新添加');location.href='/cate/cateadd';</script>";
        }
    }
//    删除
    public function del($id)
    {
//        当前分类下是否有子类
        $delWhere=[
            ['pid','=',$id]
        ];
        $count=DB::table('cate')->where($delWhere)->count();
        if($count>0){
            echo "<script>alert('该分类下有子分类，不能删除');location.href='/cate/cateindex';</script>";die;
        }
        $res = DB::table('cate')->where('cate_id','=',$id)->delete();
        if($res){
            echo "<script>alert('删除成功');location.href='/cate/cateindex';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='/cate/cateindex';</script>";
        }
    }

    public function update($id)
    {
        $data = DB::table('cate')->where(['cate_id'=>$id])->get()->toArray();
//        dd($data);
        $cate = DB::table('cate')->where(['pid'=>$id])->get();
//        dd($cate);
        return view('admin/cate/cateedit',['data1'=>$data],['cate'=>$cate]);
    }
    public function do_update(request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('cate')->where('cate_id',$data['cate_id'])->update([
            'cate_name'=>$data['cate_name'],
            'pid'=>$data['pid'],
            'cate_show'=>$data['cate_show'],
            'cate_new_show'=>$data['cate_new_show']
        ]);
        if($res){
            echo "<script>alert('修改成功');location.href='/cate/cateindex';</script>";
        }else{
            echo "<script>alert('修改失败');location.href='/cate/cateindex';</script>";
        }
    }
}
