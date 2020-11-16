<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Role;
use App\Model\Juri;


class RoleController extends Controller
{
    public function index(){
        return view("/admin/role/index");

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function create(){
        $res = Juri::get();
        // dd($res);
        return view("/admin/role/create",['res'=>$res]);
    }
    public function store(Request $request){
        $data = $request->except('_token');
        $res = Role::create($data);
        $a = time();
        dd($a);die;
        if($res){
            return view("/admin/role/index");
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
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
