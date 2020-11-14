<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Model\Role;
use App\Model\Juri;
=======
>>>>>>> 14bf110a0a748cabf1648647c5f09572acd194bc

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


<<<<<<< HEAD
=======
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
>>>>>>> 14bf110a0a748cabf1648647c5f09572acd194bc


}
