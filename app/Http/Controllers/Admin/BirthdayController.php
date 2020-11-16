<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Birthday;
class BirthdayController extends Controller
{
    
    
    public function create(){
    	

    	return view('admin.birthday.create');
    }


    public function store(Request $request){
    	$post=$request->except('_token');
    	$birthday_name =  $request->input('birthday_name');
    	$birthday_tel =  $request->input('birthday_tel');
    	$birthday_email =  $request->input('birthday_email');
    	$birthday_shenfen =  $request->input('birthday_shenfen');
    	$str = time();

    	$data = [

    		'birthday_name' =>$birthday_name,
    		'birthday_tel' =>$birthday_tel,
    		'birthday_email' =>$birthday_email,
    		'birthday_shenfen' =>$birthday_shenfen,
    		'birthday_time' =>$str

    	];

    	 $AdminModel = new Birthday();
            //唯一性验证
            $birthday_name = $AdminModel::where('birthday_name', $birthday_name)->first();
            $birthday_tel = $AdminModel::where('birthday_tel', $birthday_tel)->first();
            $birthday_shenfen = $AdminModel::where('birthday_shenfen', $birthday_shenfen)->first();
            if ($birthday_name) {
                return redirect('/birthday/create')->with('mss', '姓名已存在，请重新添加');
                die;
            }

            if ($birthday_tel) {
                return redirect('/birthday/create')->with('mss', '手机号码已存在，请重新添加');
                die;
            }
             if ($birthday_shenfen) {
                return redirect('/birthday/create')->with('mss', '身份证号已经存在，请重新添加');
                die;
            }

    	$sql = Birthday::insert($data);
    	if($sql){
    		 return redirect('/birthday/list');
    	}


    }



    public function list(){
    	echo 123456;
    }



    
}
