<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PositionModel;
use App\Model\AdModel;

class AdController extends Controller
{
	public function index()
    {
        $ad=AdModel::where(['is_del'=>0])->orderBy('ad_id','desc')->paginate(2);
        // dd($ad);
        if(request()->ajax()){
            return view('admin.ad.ajaxpage',['ad'=>$ad]);
        }
        return view('admin.ad.index',['ad'=>$ad]);
    }

	
    public function create(){
    	$position=PositionModel::get();
    	return view('admin.ad.create',['position'=>$position]);
    }
     public function store(Request $request){
    	$post=$request->except('_token');
    	dd($post);
        $request->validate([
            'ad_name' => 'required|unique:ad',
            'link_phone'=>'digits_between:10,11',
            'link_email' => 'required',
            ],[
                'ad_name.required'=>'广告名称不能为空',
                'ad_name.unique'=>'广告名称已存在',
                'link_phone.required'=>'联系电话不能为空',
                'link_email.required'=>'管理员邮箱不能为空',
                'link_phone.digits_between'=>'联系电话11位',
            ]);
        if($request->hasFile('ad_imgs')){
            $post['ad_imgs']=$this->upload('ad_imgs');
        }
        $post['ad_code']=time();
        $post['start_time']=strtotime($post['start_time'])??'';
        $post['end_time']=strtotime($post['end_time'])??'';
        $res=AdModel::create($post);
        // dd($res);
        if($res){
            return redirect('/ad');
        }
    }
     public function upload(Request $request){
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
                $photo=$request->file;
                $store_result = $photo->store('photo');
                // return $this->success('上传成功',env('IMG_URL').$store_result);
                return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('UPLOAD_URL')."/".$store_result]);
                }
                // return $this->error('上传失败');
                return json_encode(['code'=>2,'msg'=>'上传失败']);
         }
    //删除
    public function destroy($id=0){
       //  dd($id);
       $res=AdModel::where('ad_id',$id)->update(['is_del'=>1]);
       // dd($res);
        // $res=AdModel::destroy($id);
       if($res){
            return response()->json(['code'=>0,'msg'=>'删除成功!']);
        }
        if($res){
            return redirect('/ad');
        }
    }
    //即点即改
    public function change(Request $request){
        $ad_name=$request->ad_name;
        $id=$request->id;
        if(!$ad_name || !$id){
            return response()->json(['code'=>3,'msg'=>'缺少参数']);
        }
        $res=AdModel::where('ad_id',$id)->update(['ad_name'=>$ad_name]);
        if($res){
            return response()->json(['code'=>0,'msg'=>'修改成功']);
        }
    }
    //修改
    public function edit($id){
        $ad=AdModel::find($id);
        $position=PositionModel::all();
        // dd($position);
        return view('admin.ad.edit',['ad'=>$ad,'position'=>$position]);
    }
    //执行修改
    public function update(Request $request,$id){
        $post=$post=$request->except('_token');
        $request->validate([
            'ad_name' => 'required|unique:ad',
            'link_phone'=>'digits_between:10,11',
            'link_email' => 'required',
            ],[
                'ad_name.required'=>'广告名称不能为空',
                'ad_name.unique'=>'广告名称已存在',
                'link_phone.required'=>'联系电话不能为空',
                'link_email.required'=>'管理员邮箱不能为空',
                'link_phone.digits_between'=>'联系电话11位',
            ]);
        $post['ad_code']=time();
        $post['start_time']=strtotime($post['start_time'])??'';
        $post['end_time']=strtotime($post['end_time'])??'';
        $res=AdModel::where('ad_id',$id)->update($post);
        if($res){
            return redirect('/ad');
        }
    }
    public function checkOnly(){
        $ad_name=request()->ad_name;
        $count=AdModel::where('ad_name',$ad_name)->count();
        
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
