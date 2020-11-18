<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('coupon')->get();
        return view('admin/coupon/couponindex', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/coupon/couponadd');
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
        $res = DB::table('coupon')->insert([
            'name' => $data['name'],
            'condition' => $data['condition'],
            'condition_pic' => $data['condition_pic'],
            'number' => $data['number'],
            'total' => $data['total'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'state' => $data['state'],
            'explain'=>$data['explain'],
            'shape'=>$data['shape'],
            'shape_pic'=>$data['shape_pic'],
            'range'=>$data['range']
        ]);
        if ($res) {
            echo "<script>alert('添加成功,跳转至列表页');location.href='/coupon/index';</script>";
        } else {
            echo "<script>alert('添加失败,请重新添加');location.href='/coupon/create';</script>";
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
        $data = DB::table('coupon')->where(['coupon_id'=>$id])->get();
//        dd($data);
        return view('/admin/coupon/couponedit',['data'=>$data]);
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
        $res = DB::table('coupon')->where('coupon_id',$data['coupon_id'])->update([
            'name' => $data['name'],
            'condition' => $data['condition'],
            'condition_pic' => $data['condition_pic'],
            'number' => $data['number'],
            'total' => $data['total'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'state' => $data['state'],
            'explain'=>$data['explain'],
            'shape'=>$data['shape'],
            'shape_pic'=>$data['shape_pic'],
            'range'=>$data['range']
        ]);
        if($res){
            echo "<script>alert('修改成功');location.href='/coupon/index';</script>";
        }else{
            echo "<script>alert('修改失败');location.href='/coupon/index';</script>";
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
        $res = DB::table('coupon')->where(['coupon_id'=>$id])->delete();
        if ($res) {
            echo "<script>alert('删除成功,跳转至列表页');location.href='/coupon/index';</script>";
        } else {
            echo "<script>alert('删除失败');location.href='/coupon/index';</script>";
        }
    }
}
