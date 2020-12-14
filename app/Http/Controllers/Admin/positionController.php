<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PositionModel;
use App\Model\AdModel;
use App\Http\Requests\StorePositionPost;
use Validator;

class positionController extends Controller
{
	public function index(){
		$position=PositionModel::where(['is_del'=>0])->paginate(20);
		//dd($position);
        if(request()->ajax()){
            return view('admin.ad.position.ajapage',['position'=>$position]);
        }
		return view('admin.ad.position.index',['position'=>$position]);
	}
    public function create(){
    	return view('admin.ad.position.create');
    }
    public function store(Request $request){
    	$post=$request->except('_token');
    	// dd($post);
        // $request->validate([
        //     'position_name' => 'required|unique:ad_position',
        //     'ad_width' => 'required',
        //     'ad_height' => 'required',
        //     ],[
        //         'position_name.required'=>'广告位名称不能为空',
        //         'position_name.unique'=>'广告位名称已存在',
        //         'ad_width.required'=>'广告位宽度不能为空',
        //         'ad_height.required'=>'广告位高度不能为空',
        //     ]);
        $validator = Validator::make($request->all(),
            [
            'position_name' => 'required|unique:brand',
            'ad_width' => 'required',
            'ad_height' => 'required',
            ],[
                'position_name.required'=>'广告位名称不能为空',
                'position_name.unique'=>'广告位名称已存在',
                'ad_width.required'=>'广告位宽度不能为空',
                'ad_height.required'=>'广告位高度不能为空',
            ]);
        if ($validator->fails()) {
            return redirect('ad/position/create')
            ->withErrors($validator)
            ->withInput();
        }
    	$res=PositionModel::insert($post);
    	if($res){
            return redirect('ad/position');
        }
    }

    public function showads(Request $request,$position_id){
        // echo "123";die;
        $ad=AdModel::leftjoin('ad_position','ad.position_id','=','ad_position.position_id')->orderBy('ad_id','desc')->where('ad.position_id',$position_id)->paginate(20);
        return view('admin.ad.index',['ad'=>$ad]);
    }

    public function createhtml(Request $request,$position_id){
        $position=PositionModel::find($position_id);
        if($position->template==1){
            $ad=AdModel::find($position_id);
            // dd($ad);
            $template='onepic';
        }elseif($position->template==2){
            $ad=AdModel::where('position_id',$position_id)->get();
            // dd($ad);
            $template='morepic';
        }
        $content=view('admin.ad.lib.'.$template,['ads'=>$ad,'width'=>$position->ad_width,'height'=>$position->ad_height])->render();
        $content='document.write(\''.$content.'\');';
        $filename=public_path('\ads\\'.$position_id.'.js');
        // dd($filename);
        $res=file_put_contents($filename,$content);
        if($res){
            echo "<script>alert('生成成功！');history.go(-1);</script>";
        }
    }

    //删除
    public function destroy($id=0){
        // dd($id);
        $ad=AdModel::where('position_id',$id)->first();
        // dd($ad);
        if($ad){
            return response()->json(['code'=>0,'msg'=>'此广告位下有广告,不能删除!']);
        }
        $res=PositionModel::where('position_id',$id)->update(['is_del'=>1]);
        //dd($res);
        // $res=PositionModel::destroy($id);
        if($res){
            return response()->json(['code'=>0,'msg'=>'删除成功!']);
        }
        if($res){
            return redirect('/ad/position');
        }
    }
    public function edit($id){
        $position=PositionModel::find($id);
        // dd($position);
        return view('admin.ad.position.edit',['position'=>$position]);
    }
    public function update(StorePositionPost $request,$id){
        $post=$request->except('_token');
        // dd($post);
        // $request->validate([
        //     'position_name' => 'required|unique:ad_position',
        //     'ad_width' => 'required',
        //     'ad_height' => 'required',
        //     ],[
        //         'position_name.required'=>'广告位名称不能为空',
        //         'position_name.unique'=>'广告位名称已存在',
        //         'ad_width.required'=>'广告位宽度不能为空',
        //         'ad_height.required'=>'广告位高度不能为空',
        //     ]);
        $res=PositionModel::where('position_id',$id)->update($post);
        if($res){
            return redirect('ad/position');
        }
    }
    //即点即改
    public function change(Request $request){
        $field=$request->field;
        $value=$request->newname;
        $id=$request->id;
        // dd($position);
        if(!$field){
            return response()->json(['code'=>3,'msg'=>'缺少参数']);
        }
        $res=PositionModel::where('position_id',$id)->update([$field=>$value]);
        if($res){
            return response()->json(['code'=>0,'msg'=>'修改成功']);
        }
    }
    public function checkOnly(){
        $position_name=request()->position_name;
        $count=PositionModel::where('position_name',$position_name)->count();
        
        return json_encode(['code'=>'00000','count'=>$count]);
    }
}
