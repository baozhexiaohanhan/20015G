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

    }

    public function create(){
        $juri = Juri::get();
        // dd($res);
        return view("/admin/role/create",['juri'=>$juri]);
    }
    public function store(Request $request){
        $role_name = $request->input('role_name');
        $juri = $request->input('juri');
        $role_desc = $request->input('$role_desc');
        // $str = $request->except('_token');
        $time = time();
        // $str = implode($juri);
            $data = [
                'role_name' => $role_name,
                'juri' => $juri,
                'role_desc' => $role_desc,
                'role_time' => $time
            ];
        $res = Role::insert($data);
        // dd($a);die;
        if($res){
            return view("/admin/role/index");
        }
    }

}
