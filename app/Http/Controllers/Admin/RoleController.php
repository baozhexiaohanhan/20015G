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
        $res = Juri::get();
        // dd($res);
        return view("/admin/role/create",['res'=>$res]);
    }
    public function store(Request $request){
        $data = $request->except('_token');
        dd($data);
    }




}
