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


}
