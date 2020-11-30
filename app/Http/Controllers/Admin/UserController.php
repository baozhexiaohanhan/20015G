<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Region;
use App\Model\Seller;
use App\Model\Goods;
use App\Model\Order_info;
use DB;
class UserController extends Controller
{
    public function user(){
        $region = Region::where("parent_id",0)->get();
        return view("admin.business.user",compact("region"));
    }
    public function region(){
        $parent_id = request()->region_id;
        // dd($parent_id);
        $region = Region::where("parent_id",$parent_id)->get();
        if($region){
            return $message = [
                "code"=>00,
                "msg"=>"获取到",
                "data"=>$region,
            ];
        }
    }
    public function user_add(Request $request){
        $data = request()->except(['repassword',"_token"]);
        // dd($data);
        if($request->hasFile("paper_img")){
            $datas=$this->upload('paper_img');
        }
        $data['paper_img'] = env('UPLOAD_URL').'/'.$datas;
        $data['create_time'] = time();
        $res = Seller::insert($data);
        dd($res);
    }
    public function upload($img){
        $file=request()->file($img);//接收文件
        //判断上传过程中有无错误
        if($file->isValid()){
            $store_result=$file->store('uploadss');
            return $store_result;
        }

        exit('未获取到上传文件或上传文件过程中出错');
    }
    public function user_log(){
        return view("admin.business.user_log");
    }
    public function log_add(){
        $data = request()->all();
        $res = Seller::where(['seller_name'=>$data['seller_name'],"is_del"=>0])->first();
        if(!$res){
            return $msg = [
                "code"=>0002,
                "msg"=>"用户或密码错误",
            ];
        }
       
        // dd($data);
        $res2 = Seller::where(['seller_name'=>$data['seller_name'],"is_lock"=>0,"is_del"=>0])->first();
        if($res2){
            if($res['password']==$data['password']){
                session(["seller"=>$res]);
                return $msg = [
                    "code"=>0001,
                    "msg"=>"登录成功",
                ];
            }
        }else{
            return $msg = [
                "code"=>0002,
                "msg"=>"审核未通过",
            ]; 
        }
       
        // dd($res);
    }
    public function user_up(){
        $user = session()->get("seller");
        // dd();
        $res = Seller::where("seller_id",$user['seller_id'])->first();
        $region = Region::where("parent_id",0)->get();
        return view("admin.business.user_up",compact("region","res"));
    }
    public function user_up_add($id){
        // dd($id);
        $data = request()->except(['repassword',"_token"]);
        if(request()->hasFile("paper_img")){
            $datas=$this->upload('paper_img');
        }
        $data['paper_img'] = env('UPLOAD_URL').'/'.$datas;
        // dd($data);
        $res = Seller::where("seller_id",$id)->update($data);
        if($res){
            return redirect("/business/user_up");
        }
    }

    // 统计
    public function statistics(){
        $user = session()->get("seller");
        
        $count_goods = Goods::where("seller_id",$user['seller_id'])->count();
        $order_count = Order_info::where("seller_id",$user['seller_id'])->count();
        $price =  Order_info::where(["seller_id"=>$user['seller_id'],"pay_status"=>1])->sum("order_price");
        return view("admin.business.statistics",compact("count_goods","order_count","price"));

    }
}
