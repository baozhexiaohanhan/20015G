<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
class LoginController extends Controller
{
   public function reg(){


   }

   public function login(){
   		return view('admin.admin.login');
   }


   public function logindo(){

   	  $admin_name = Request()->input('admin_name');
      $admin_pwd = Request()->input('admin_pwd');
	  if(empty($admin_name) || empty($admin_pwd)){
          return redirect('login')->with('msg','用户名或密码不能为空');die;
      }
      $ret = Admin::where('admin_name',$admin_name)->first();
      if(!$ret){
          return redirect('login')->with('msg','账号或密码错误');die;
      }
      if(password_verify($admin_pwd,$ret->admin_pwd)){
              session(['admin_name' => $ret->admin_name]);
              return redirect('/admins');die;
      }else{
            return redirect('login')->with('msg','账号或密码错误');die;
      }
    }


   }

