<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class couponController extends Controller
{
    //优惠券添加
    public function couponadd()
    {
        return view('admin/coupon/couponadd');
    }

//    优惠券添加执行
    public function do_coupon(request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('coupon')->insert([
            'name' => $data['name'],
            'pic' => $data['pic'],
            'condition' => $data['condition'],
            'number' => $data['number'],
            'total' => $data['total'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'state' => $data['state']
        ]);
        if ($res) {
            echo "<script>alert('添加成功,跳转至列表页');location.href='/coupon/couponindex';</script>";
        } else {
            echo "<script>alert('添加失败,请重新添加');location.href='/coupon/couponadd';</script>";
        }
    }

    public function couponindex()
    {
        $data = DB::table('coupon')->get();
        return view('admin/coupon/couponindex', ['data' => $data]);
    }

    public function del($id)
    {
        $res = DB::table('coupon')->where(['coupon_id'=>$id])->delete();
        if ($res) {
            echo "<script>alert('删除成功,跳转至列表页');location.href='/coupon/couponindex';</script>";
        } else {
            echo "<script>alert('删除失败,请重新添加');location.href='/coupon/couponindex';</script>";
        }
    }
    public function edit($id)
    {
        $data = DB::table('coupon')->where(['coupon_id'=>$id])->get();
//        dd($data);
        return view('/admin/coupon/couponedit',['data'=>$data]);
    }
    public function do_edit(request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('coupon')->where('coupon_id',$data['coupon_id'])->update([
            'name' => $data['name'],
            'pic' => $data['pic'],
            'condition' => $data['condition'],
            'number' => $data['number'],
            'total' => $data['total'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'state' => $data['state']
        ]);
        if($res){
            echo "<script>alert('修改成功');location.href='/coupon/couponindex';</script>";
        }else{
            echo "<script>alert('修改失败');location.href='/coupon/couponindex';</script>";
        }
    }
}
