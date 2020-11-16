<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
class BrandController extends Controller
{

	public function index(){
		$brand=BrandModel::paginate(2);
        if(request()->ajax()){
            return view('admin.brand.ajaxpage',['brand'=>$brand]);
        }
		return view('admin.brand.index',['brand'=>$brand]);
	}
    public function create(){
    	return view('admin.brand.create');
    }
    public function store(Request $request){
    	$post=$request->except(['_token','file']);

        $request->validate([
            'brand_name' => 'required|unique:brand',
            'brand_url' => 'required',
            ],[
                'brand_name.required'=>'品牌名称不能为空',
                'brand_name.unique'=>'品牌名称已存在',
                'brand_url.required'=>'品牌网址不能为空',
            ]);
    	
    	if($request->hasFile('brand_logo')){
            $post['brand_logo']=$this->upload('brand_logo');
        }
        // dd($post);
        $res=BrandModel::insert($post);
        // dd($res);
        if($res){
        	return redirect('/brand');
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

    // 删除
    public function destroy($id=0){
        $id=request()->id?:$id;
        //dd($id);
        if(!$id){
            return;
        }
        $res=BrandModel::destroy($id);
        if(request()->ajax()){
            // return $this->success('删除成功');
            return response()->json(['code'=>0,'msg'=>'删除成功!']);
        }
        if($res){
            return redirect('/brand');
        }

    }
    //即点即改
    public function change(Request $request){
        $field=$request->field;
        $id=$request->id;
        $value=$request->newname;
        // dd($field);
        if(!$field || !$id || !$value){
         return response()->json(['code'=>3,'msg'=>'缺少参数']);
        }
        $res=BrandModel::where('brand_id',$id)->update([$field=>$value]);
        if($res){
            return response()->json(['code'=>0,'msg'=>'修改成功']);
        }
    }

    //修改
    public function edit($id){
        $brand=BrandModel::find($id);
        // dd($brand);
        return view('admin.brand.edit',['brand'=>$brand]);
    }
    //修改执行
    public function update(Request $request,$id){
        $post=$request->except(['_token','file']);
        // dd($post);
        $request->validate([
            'brand_name' => 'required|unique:brand',
            'brand_url' => 'required',
            ],[
                'brand_name.required'=>'品牌名称不能为空',
                'brand_name.unique'=>'品牌名称已存在',
                'brand_url.required'=>'品牌网址不能为空',
            ]);
        $res=BrandModel::where('brand_id',$id)->update($post);
        if($res){
            return redirect('/brand');
        }
    }
    public function checkOnly(){
        $brand_name=request()->brand_name;
        $count=BrandModel::where('brand_name',$brand_name)->count();
        
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
