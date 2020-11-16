<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Model\Role;
use App\Model\Right;
use Illuminate\Validation\Rule;
use Validator;
use App\Model\Role_right;
class RoleController extends Controller
{
    //角色添加
    public function role(){
        return view('admin.role.role');
    }

    //执行
    public function roledo(){
        $data=request()->all();
       $validator= Validator::make($data,[
           'role_name'=>'required|unique:role',
           'role_desc'=>'required',
       ],[
           'role_name.required'=>'角色名称不能为空',
           'role_name.unique'=>'角色已存在',
           'role_desc.required'=>'简介不能为空'
       ]
       );
       if ($validator->fails()) {
        return redirect('role/role')
        ->withErrors($validator)
        ->withInput();
        }

        $data['role_time']=time();
        $RoleModel=new Role();
        $reg=$RoleModel->create($data);
        if($reg){
            return redirect('/role/roindex');
        }else{
            return redirect('/role/role');
        }
    }
    //展示
    public function roindex(){
        $RoleModel= new Role();
        $data=$RoleModel->where('is_del',1)->orderBy('role_id','desc')->paginate(3);
        return view('admin.role.roindex',compact('data'));
    }

    //删除
    public function rodel($id){
        // dd($id);
        $RoleModel=new Role();
        $res=$RoleModel->where('role_id',$id)->update(['is_del'=>2]);
        // dd($reg);
        if($res){
            if(request()->ajax()){
                return json_encode(['error_no'=>'2','error_msg'=>'删除成功']);
            }
            return redirect('/admin/roindex');
        }
    }

    //修改
    public function roedit($id){
       //dd($id);
       $RoleModel=new Role();
       $data=$RoleModel->where('role_id',$id)->first();
       return view('admin.role.edit',compact('data'));
    }

    //执行修改
    public function roup($id){
       //dd($id);
       $data=request()->all();
       $validator=Validator::make($data,[
           'role_name'=>[
               'required',
               Rule::unique('role')->ignore($id,'role_id')
           ],
           'role_desc'=>'required'

        ],[
             'role_name.required'=>'角色名称不能为空',
             'role_desc'=>'简介不能为空'
        ]);
        if ($validator->fails()) {
            return redirect('role/roedit')
            ->withErrors($validator)
            ->withInput();
            }

       $data['role_time']=time();
       $RoleModel=new Role();
       $reg=$RoleModel->where('role_id',$id)->update($data);
       if($reg){
           return redirect('/role/roindex');
       }else{
           return redirect('/role/role');
       }
    }
     //无限极分类
     public function list_level($data,$parent_id=0,$level=1){
        if(!$data){
            return false; 
        }
        static $array=[];
        foreach($data as $k=>$v){
            if($v->parent_id==$parent_id){
                $v->level=$level;
                $array[]=$v;
                $this->list_level($data,$v->right_id,$level+1);
            }
        }

        return $array;
}
    //角色添加权限
    public function right(){
        $role_id=request()->id;
        $Role_rightModel=new Role_right();
        $rights=$Role_rightModel->where('role_id',$role_id)->get();
        
        $datas=[];
        foreach($rights as $k=>$v){
            $datas[]=$v;
        }

       $right_id=[];
       foreach($datas as $k=>$v){
           $right_id[]=$v['right_id'];
       }
       
        $RightModel=new Right();
        $data=$RightModel->get();
        //dd($data);
       $reg= $this->list_level($data);
        return view('admin.role.rights',compact('reg','role_id','right_id'));
    }
    public function rightdo(){
          $data=request()->all();
          if(isset($data['rightCheck'])){
              $Role_rightModel=new Role_right();
              $Role_rightModel->where('role_id',$data['role_id'])->delete();
              $datas=[];
              foreach($data['rightCheck'] as $v){
              
                  $datas[]=[
                      'role_id'=>$data['role_id'],
                      'right_id'=>$v
                  ];
              }
              //dd($datas);
              $reg=$Role_rightModel->insert($datas);
          }

          if($reg){
            return redirect('/role/roindex');
          }
           
    }
}
