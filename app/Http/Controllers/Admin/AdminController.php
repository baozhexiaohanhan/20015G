<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use App\Model\Role;
use App\Model\Notice;
class AdminController extends Controller
   {
    //管理员类别
    public function list(){
      $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['admin_name','like',"%$name%"];
        }
     $AdminModel = new Admin();
    $data = $AdminModel->where($where)->orderBy('admin_id','desc')->paginate(2);
        $query = request()->all();

     if (Request()->ajax()){
        return view('admin.admin.ajaxpage', ['data' => $data,'query'=>$query]);
    }
      return view('admin.admin.list',['data'=>$data,'query'=>$query]);
  }

//添加视图

    public function addlist(){
     		$role = Role::all();
    	return view('admin.admin.addlist',['role'=>$role]);
    }
//添加方法
    public function create(Request $request){
    	  $admin_pwd =  $request->input('admin_pwd');
    	  $admin_name =  $request->input('admin_name');
    	  $admin_tel =  $request->input('admin_tel');
    	  $email =  $request->input('email');
    	  $role = $request->input('role');
    	  $time = time();
    	  $str = implode($role);
    	     	$data = [
              'admin_pwd' => password_hash($admin_pwd,PASSWORD_DEFAULT),
              'admin_name' => $admin_name,
              'admin_tel' => $admin_tel,
              'email' => $email,
              'role' => $str,
              'admin_time'=>$time
          ];
    	$res = Admin::insert($data);
         if($res){
             return redirect('/admin/list');
         }
    }
//删除

    public function destroy($id){
             $res = Admin::where('admin_id',$id)->delete();
        if($res){
            if(request()->ajax()){
                return json_encode(['error_no'=>'1','error_msg'=>'删除成功']);
            }
            return redirect('/admin/list');
        }
    }
    //公告视图
    public function notice(){


        return view('admin.notice.notice');

    }
//公告添加

    public function createlist(Request $request){
        $notice_name =  $request->input('notice_name');
        $notice_tel =  $request->input('notice_tel');
        $notice_fullname =  $request->input('notice_fullname');
        $time = time();
        $data = [
              'notice_name' => $notice_name,
              'notice_tel' => $notice_tel,
              'notice_fullname' => $notice_fullname,
              'notice_time'=>$time
          ];

          $res = Notice::insert($data);
         if($res){
             return redirect('/admin/noticelist');
         }
    }

    public function noticelist(){
   $noticeModel = new Notice();
    $data = $noticeModel->orderBy('notice_id','desc')->get();
    return view('admin.notice.noticelist',['data'=>$data]);
    }
}
