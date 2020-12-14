<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Goods;
use App\Model\Cate;
use App\Model\BrandModel;
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
        return view('admin/coupon/couponindex', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $goods=Goods::all();
//        dd($goods);
//        $cate=Cate::all();
////        dd($cate);
//        $brand=BrandModel::all();
        return view('admin/coupon/couponadd',['goods'=>$goods]);
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
            'name' => 'required',
            'range' => 'required',
            'user_rank' => 'required',
            'max_amount' => 'required',
            'min_amount' => 'required',
            'type' => 'required',
            'type_ext' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ],[
            'name.required'=>'优惠券名称必填',
            'range.required'=>'优惠范围必填',
            'user_rank.required'=>'会员等级必填',
            'max_amount.required'=>'金额上限必填',
            'min_amount.required'=>'金额下限必填',
            'type.required'=>'优惠方式必填',
            'type_ext.required'=>'优惠金额必填',
            'start_time.required'=>'开始时间必填',
            'end_time.required'=>'结束时间必填',
        ]);
        $res = DB::table('coupon')->insert([$data]);
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
    //    dd($id);
       $data = DB::table('coupon')->where(['coupon_id'=>$id])->first();
    //    dd($data);
       $goods = DB::table('goods')->get();
       return view('/admin/coupon/couponedit',['data'=>$data,'goods'=>$goods]);
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
           'start_time' => $data['start_time'],
           'end_time' => $data['end_time'],
           'range'=>$data['range'],
           'user_rank'=>$data['user_rank'],
           'max_amount'=>$data['max_amount'],
           'min_amount'=>$data['min_amount'],
           'type'=>$data['type'],
           'type_ext'=>$data['type_ext'],
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
