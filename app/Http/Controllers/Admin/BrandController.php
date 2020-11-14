<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\BrandModel;
class BrandController extends Controller
{

	public function index(){
		$brand=BrandModel::paginate(2);
		// dd($brand);
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
                return json_encode(['code'=>0,'msg'=>'上传成功','data'=>env('IMG_URL').$store_result]);
                }
                // return $this->error('上传失败');
                return json_encode(['code'=>2,'msg'=>'上传失败']);
         }

    // 删除
    public function destroy($id=0){
        $res=BrandModel::destroy($id);
        if($res){
            return response()->json(['code'=>3,'msg'=>'删除成功!']);
        }
        if($res){
            return redirect('/brand');
        }

    }
}
