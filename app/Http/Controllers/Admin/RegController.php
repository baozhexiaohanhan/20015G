<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
use App\Model\Role;
use App\Model\AdminRole;
use Illuminate\Validation\Rule;
use DB;
class RegController extends Controller
{
    public function reg(){

        $code = $this->getImageCodeUrl(request());
        return view('admin.reg.reg',['code'=>$code]);
    }

    public function regdo(Request $request){
        $data = $request->all();
        $code = session('code');

        $res = Admin::where(['admin_name'=>$data['admin_name'],'admin_pwd'=>$data['admin_pwd']])->first();
        if(!$res){
            return redirect('/admin/reg')->with('msg','账号或密码错误');
        }else if($data['code']!=$code){
            return redirect('/admin/reg')->with('msg','验证码错误');
        } else{
            session(['login' => $res]);
            return redirect('/admin/index');
        }

    }

    public function quit(){
        session(['login' => null]);
        return redirect('/admin/reg');
    }


    public function create(){
        $RoleModel=new Role();
        $data=$RoleModel->get();
        //dd($data);
        return view('admin.reg.create',compact('data'));
    }

    public function rstore(Request $request){
        DB::beginTransaction();
        try{
        $role=$request->role;
        //dd($role);
        $data = $request->except('_token','role');
        // $data['admin_pwd']=bcrypt($data['admin_pwd']);
        // dd($data);
        $data['admin_time']=time();
        $validatedData = $request->validate([
            'admin_name' => 'required|unique:admin',
            'admin_pwd' => 'required',
        ],[
            'admin_name.required'=>'管理员名称不能为空',
            'admin_name.unique'=>'管理员名称已存在',
            'admin_pwd.required'=>'密码不能为空',
        ]);
        $res = Admin::create($data);
        if($res){
             if(count($role)){
                 foreach($role as $k=>$v){
                     $admin_role[]=[
                         'admin_id'=>$res->admin_id,
                         'role_id'=>$v
                     ];
                 }
                 $AdminRoleModel=new AdminRole();
                $AdminRoleModel->insert($admin_role);
              
             }
             DB::commit();
             return redirect('/admin/list');
            }  
        }catch(Exception $e){
            DB::rollBack();
            dump($e->getMessage());
        }
    }

    public function index(){
        $admin_name = request()->admin_name;
        $where = [];
        if($admin_name){
            $where[] = ['admin_name','like',"%$admin_name%"];
        }
        $where[]=['is_del',1];
        $data = Admin::where($where)->orderBy('admin_id','desc')->paginate(2);
        return view('admin.reg.index',['data'=>$data]);
    }

    public function delete($id=0){
        $id = request()->id?:$id;
        if(!$id){
            return;
        }
        $res = Admin::where('admin_id',$id)->update(['is_del'=>2]);
        if(request()->ajax()){
            return response()->json(['code'=>0,'msg'=>'删除成功']);
        }
        if($res){
            return  redirect('/list');
        }
    }


    public function redit($id){
        $data = Admin::find($id);
        return view('admin.reg.edit',['data'=>$data]);
    }

    public function rupdate(Request $request,$id){
        $data = $request->except('_token');

        $validatedData = $request->validate([
            'admin_name' =>
                [
                    'required',
                    Rule::unique('admin')->ignore(request()->admin_id,'admin_id')
                ],
             'admin_pwd' => 'required'
        ], [

            'admin_name.required'=>'管理员名称不能为空',
            'admin_name.unique'=>'管理员名称已存在',
            'admin_pwd.required'=>'密码不能为空',
        ]);
//            'admin_name' => 'required|unique:admin',
//            'admin_pwd' => 'required',
//        ],[
//            'admin_name.required'=>'管理员名称不能为空',
//            'admin_name.unique'=>'管理员名称已存在',
//            'admin_pwd.required'=>'密码不能为空',
//        ]);
            $res = Admin::where('admin_id',$id)->update($data);
            if($res==='0'){
                return redirect('/admin/list');
            }else if($res==='1'){
                return redirect('/admin/list');
            }else{
                return redirect('/admin/list');
            }
    }

    /**
     * 获取图片验证码的url
     * @param Request $request
     */
    public function getImageCodeUrl(Request $request){
        $request->session()->start();
        $sid = $request->session()->getId();
        $domain = str_replace(
            $request->path(),
            '',
            $request->url()
        );
        $image_code_url = $domain . 'admin/imageCode?sid='.$sid;
        $api_return_arr = [
            'image_url'=>$image_code_url,
            'sid'=>$sid
        ];
        return $api_return_arr;
//        echo $sid;
//        echo $image_code_url;
//        exit;

    }
    public function imageCode( Request $request){
        // 设置session
//        session_start();
        // 设置验证码生成几位
        $num = 4;
        // 设置宽度
        $width = 100;
        // 设置高度
        $height = 30;
        //生成验证码，也可以用mt_rand(1000,9999)随机生成
        $Code = "";
        for ($i = 0; $i < $num; $i++) {
            $Code .= mt_rand(0,9);
        }

        // 将生成的验证码写入session
        $request->session()->put('code', $Code);
        $request->session()->save();

        // 设置头部
        header("Content-type: image/png");

        // 创建图像（宽度,高度）
        $img = imagecreate($width,$height);

        //创建颜色 （创建的图像，R，G，B）
        $GrayColor = imagecolorallocate($img,230,230,230);
        $BlackColor = imagecolorallocate($img, 0, 0, 0);
        $BrColor = imagecolorallocate($img,52,52,52);

        //填充背景（创建的图像，图像的坐标x，图像的坐标y，颜色值）
        imagefill($img,0,0,$GrayColor);

        //设置边框
        imagerectangle($img,0,0,$width-1,$height-1, $BrColor);

        //随机绘制两条虚线 五个黑色，五个淡灰色
        $style = array ($BlackColor,$BlackColor,$BlackColor,$BlackColor,$BlackColor,$GrayColor,$GrayColor,$GrayColor,$GrayColor,$GrayColor);
        imagesetstyle($img, $style);
        imageline($img,0,mt_rand(0,$height),$width,mt_rand(0,$height),IMG_COLOR_STYLED);
        imageline($img,0,mt_rand(0,$height),$width,mt_rand(0,$height),IMG_COLOR_STYLED);

        //随机生成干扰的点
        for ($i=0; $i < 200; $i++) {
            $PointColor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
            imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$PointColor);
        }

        //将验证码随机显示
        for ($i = 0; $i < $num; $i++) {
            $x = ($i*$width/$num)+mt_rand(5,12);
            $y = mt_rand(5,10);
            imagestring($img,7,$x,$y,substr($Code,$i,1),$BlackColor);
        }

        //输出图像
        imagepng($img);
        //结束图像
        imagedestroy($img);
        exit;
    }
}
