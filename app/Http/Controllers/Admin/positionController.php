<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PositionModel;
use App\Model\AdModel;

class positionController extends Controller
{
	public function index(){
		$position=PositionModel::where(['is_del'=>0])->paginate(2);
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
    	$res=PositionModel::insert($post);
    	if($res){
            return redirect('ad/position');
        }
    }

    public function showads(Request $request,$position_id){
        $ad=AdModel::leftjoin('ad.position_id','=','ad_position.position_id')->orderBy('ad_id','desc')->where('ad.position_id',$position_id)->get();
        // dd($ad);
    }

    public function createhtml(Request $request,$position_id){
        $position=PositionModel::find($position_id);
        if($position->template==1){
            $ad=AdModel::where('position_id',$position_id)->value('ad_imgs');
            // dd($ad);
            $template='onepic';
        }elseif($position->template==2){
            $ad=AdModel::where('position_id',$position_id)->pluck('ad_imgs');
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
    public function update(Request $request,$id){
        $post=$request->except('_token');
        // dd($post);
        $res=PositionModel::where('position_id',$id)->update($post);
        if($res){
            return redirect('ad/position');
        }
    }
}
