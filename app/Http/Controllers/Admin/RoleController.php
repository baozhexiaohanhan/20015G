<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Login;
use App\Model\Role;
class RoleController extends Controller
{
    public function list(){



    	return view('admin.role.list');
    }



    public function addlist(){
     		$role = Role::all();
    	return view('admin.role.addlist',['role'=>$role]);
    }

    public function create(Request $request){
    	 $admin_pwd =  $request->input('admin_pwd');
    	  $admin_name =  $request->input('admin_name');
    	  $admin_tel =  $request->input('admin_tel');
    	  $email =  $request->input('email');
    	  $role = $request->input('role');
    	  $time = mktime(0,0,0,date("m"),date("d")+1,date("Y"));
    	  $str = implode($role);
    	     	$data = [
              'admin_pwd' => password_hash($admin_pwd,PASSWORD_DEFAULT),
              'admin_name' => $admin_name,
              'admin_tel' => $admin_tel,
              'email' => $email,
              'role' => $str,
              'admin_time'=>$time
          ];
    	$res = Login::insert($data);
         if($res){
             return redirect('/list');
         }
    }
}
