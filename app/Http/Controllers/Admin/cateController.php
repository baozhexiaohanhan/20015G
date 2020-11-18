<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = DB::table('cate')->get();
//        dd($res);
        return view('admin/cate/cateindex',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('cate')->get();
        return view('admin/cate/cateadd',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            echo "<script>alert('添加成功,跳转至列表页');location.href='/cate/index';</script>";
        }else{
            echo "<script>alert('添加失败,请重新添加');location.href='/cate/create';</script>";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('cate')->where(['cate_id'=>$id])->get()->toArray();
//        dd($data);
        $cate = DB::table('cate')->where(['pid'=>$id])->get();
//        dd($cate);
        return view('admin/cate/cateedit',['data1'=>$data],['cate'=>$cate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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
            echo "<script>alert('修改成功');location.href='/cate/index';</script>";
        }else{
            echo "<script>alert('修改失败');location.href='/cate/index';</script>";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        判断当前分类下是否有子类
        $delWhere=[
            ['pid','=',$id]
        ];
        $count=DB::table('cate')->where($delWhere)->count();
        if($count>0){
            echo "<script>alert('该分类下有子分类，不能删除');location.href='/cate/index';</script>";die;
        }
//      判断该分类下是否有商品
        $goods = DB::table('goods')->where('cate_id','=',$id)->count();
//        dd($goods);
        if($goods>0){
            echo "<script>alert('该分类下有商品，不能删除');location.href='/cate/index';</script>";die;
        }
        $res = DB::table('cate')->where('cate_id','=',$id)->delete();
        if($res){
            echo "<script>alert('删除成功');location.href='/cate/index';</script>";
        }else{
            echo "<script>alert('删除失败');location.href='/cate/index';</script>";
        }
    }
}
