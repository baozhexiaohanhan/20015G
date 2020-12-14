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
        // $res = substr($birthday_shenfen,0,8)."******".substr($birthday_shenfen,14,18);
        // dd($res);
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
    $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['birthday_name','like',"%$name%"];
        }
         $listModel = new Birthday();
          $data = $listModel->where($where)->orderBy('birthday_id','desc')->paginate(2);
             $query = request()->all();
        if (Request()->ajax()){
                return view('admin.birthday.list',['data'=>$data,'query'=>$query]);
            }
              return view('admin.birthday.list',['data'=>$data,'query'=>$query]);
          }



          public function destroy($id){
            $res = Birthday::where('birthday_id',$id)->delete();
        if($res){
            if(request()->ajax()){
                return json_encode(['error_no'=>'1','error_msg'=>'删除成功']);
            }
            return redirect('/birthday/list');
        }
    }

    public function edit($birthday_id){
        $birthday=Birthday::find($birthday_id)->toArray();

        return view('admin.birthday.edit',['birthday'=>$birthday]);
    }

    public function update(Request $request ,$birthday_id){
       $post=$request->except(['_token']);
       $res=Birthday::where('birthday_id',$birthday_id)->update($post);
        if($res){
            return redirect('/birthday/list');
        }
    }
  }
    
