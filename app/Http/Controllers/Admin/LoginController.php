<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin;
class LoginController extends Controller
{
   public function reg(){

   }

   public function login(){
    $code = $this->getImageCodeUrl(request());
   		return view('admin.admin.login',['code'=>$code]);
   }

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








   public function logindo(){

   	  $admin_name = Request()->input('admin_name');
      $admin_pwd = Request()->input('admin_pwd');
	  if(empty($admin_name) || empty($admin_pwd)){
          return redirect('login')->with('msg','用户名或密码不能为空');die;
      }
      $ret = Admin::where('admin_name',$admin_name)->first();
      if(!$ret){
          return redirect('login')->with('msg','账号或密码错误');die;
      }
      if(password_verify($admin_pwd,$ret->admin_pwd)){
            //   session(['admin_name' => $ret->admin_name]);
            session(['login' => $ret]);
              // $admin_user = Request()->session()->get('admin_user');
              return redirect('/admins');die;
      }else{
            return redirect('login')->with('msg','账号或密码错误');die;
      }
    }

    public function loginapp(){
        
        session(['login' => null]);
        return redirect('/login');

    }
   }

