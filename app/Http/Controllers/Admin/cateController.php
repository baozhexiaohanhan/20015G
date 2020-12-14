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
        $cate_name=request()->cate_name;
        // dd($cate_name);
        $where=[];
        if($cate_name){
            $where[]=["cate_name","like","%$cate_name%"];
        }
        $res = DB::table('cate')->where($where)->get();
    //    dd($res);
        // $query = request()->all();
        $Category=$this->list_level($res);
        return view('admin/cate/cateindex',['res'=>$Category,'cate_name'=>$cate_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = DB::table('cate')->get();
        $Category=self::list_level($data);
        return view('admin/cate/cateadd',['cate'=>$Category]);
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
        $validatedData = $request->validate([
            'cate_name' => 'required|unique:cate',
            'cate_show' => 'required',
            'cate_new_show' => 'required',
        ],[
            'cate_name.required'=>'分类名称必填',
            'cate_name.unique'=>'分类名称已存在',
            'cate_show.required'=>'是否显示必填',
            'cate_new_show.required'=>'是否显示在导航栏必填',
        ]);
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
        // echo 12312;die;
        $data = DB::table('cate')->where(['cate_id'=>$id])->first();
        // dd($data);
        $cate = DB::table('cate')->get();
        $Category=self::list_level($cate);
        return view('admin/cate/cateedit',['data'=>$data,'Category'=>$Category]);
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
//    无限极分类
    public static function list_level($data,$pid=0,$level=0)//三个参数与上面index方法里面穿的参数相对应
    {
        static $array=[];
        foreach($data as $k=>$v){
            if($pid==$v->pid){
                $v->level=$level;
                $array[]=$v;
                self::list_level($data,$v->cate_id,$level+1);
            }
        }
        return $array;
    }
    // 即点即改
    public function change(Request $request){
        $cate_name=$request->cate_name;
        $id=$request->id;
        if(!$cate_name || !$id){
            return response()->json(['code'=>3,'msg'=>'缺少参数']);
        }
        $res=DB::table('cate')->where('cate_id',$id)->update(['cate_name'=>$cate_name]);
        if($res){
            return response()->json(['code'=>0,'msg'=>'修改成功']);
        }
    }
}
