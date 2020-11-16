<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Right;
use Illuminate\Validation\Rule;
use Validator;
class RightController extends Controller
{
    //权限添加
    public function right(){
        $RightModel=new Right();
        $data=$RightModel->get();
        //dd($data);
       $reg= $this->list_level($data);
       //dd($reg);
       return view('admin.right.right',compact('reg'));
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
    //执行添加
    public function rigdo(){
        $data=request()->all();
       // dd($data);
        $validator=Validator::make($data,[
            'right_name'=>'required|unique:right',
            'right_as'=>'required',
            'right_url'=>'required'
        ],[
            'right_name.required'=>'权限不能为空',
            'right_name.unique'=>'该权限已存在',
            'right_as.required'=>'权限别名不能为空',
            'right_url.required'=>'url不能为空',
        ]
    );
    if ($validator->fails()) {
        return redirect('right/right')
        ->withErrors($validator)
        ->withInput();
        }

        $data['add_time']=time();
       // dd($data);
         $RightModel=new Right();
         $reg=$RightModel->create($data);
        // dd($reg);
        if($reg){
            return redirect('/right/rigindex');
        }else{
            return redirect('/right/right');
        }
    }

    //展示
    public function rigindex(){
        $RightModel=new Right();
        $reg=$RightModel->where('is_del',1)->get();
        $reg=$this->list_level($reg);
        return view('admin.right.rigindex',compact('reg'));
    }

    //删除
    public function rigdel(){
        $id=request()->right_id;
        //dd($id);
        $RightModel=new Right();
        $regs=$RightModel->where('parent_id',$id)->first();
         if($regs){
            $message = [
                'code'=> '000001',
                'msg'=>'此菜单下还有菜单',
                'url'=>'/right/rigindex'
            ];
            return json_encode($message,JSON_UNESCAPED_UNICODE);
         }
        $reg=$RightModel->where('right_id',$id)->update(['is_del'=>2]);
        if($reg){
            $message = [
                'code'=> '000000',
                'msg'=>'删除成功',
                'url'=>'/right/rigindex'
            ];
            return json_encode($message,JSON_UNESCAPED_UNICODE);
        }else{
            $message = [
                'code'=> '000002',
                'msg'=>'删除失败',
                'url'=>'/right/rigindex'
            ];
            return json_encode($message,JSON_UNESCAPED_UNICODE);
        }
    }

    //修改
    public function rigedit($id){
       //dd($id);
       $RightModel=new Right();
       $reg=$RightModel->where('right_id',$id)->first();
       return view('admin.right.edit',compact('reg'));
    }

    //执行修改
    public function rigup($id){
         //dd($id);
         $data=request()->all();
         $validator=Validator::make($data,[
            'right_name'=>[
                'required',
                Rule::unique('right')->ignore($id,'right_id')
            ],
            'right_as'=>'required',
            'right_url'=>'required'
        ],[
            'right_name.required'=>'权限不能为空',
            'right_name.unique'=>'该权限已存在',
            'right_as.required'=>'权限别名不能为空',
            'right_url.required'=>'url不能为空',
        ]
    );
    if ($validator->fails()) {
        return redirect('admin/rigedit')
        ->withErrors($validator)
        ->withInput();
        }

         $data['add_time']=time();
        // dd($data);
          $RightModel=new Right();
          $reg=$RightModel->where('right_id',$id)->update($data);
         // dd($reg);
         if($reg){
             return redirect('/right/rigindex');
         }else{
             return redirect('/right/rigindex');
         }
    }
}
