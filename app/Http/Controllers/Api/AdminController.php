<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Notice;
use App\Model\Code;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Helpers\jwt;
use App\Helpers\functions;
use Illuminate\Support\Facades\Redis;
class AdminController extends Controller
{
    public function regdo(Request $request){
 		  $user_tel =  $request->input('user_tel');
 		  $user_pwd =  $request->input('user_pwd');
 		  $user_name =  $request->input('user_name');
          $code = $request->input('code');
          // dd($code);
 		  $time = time();
 		 $t = User::where(['user_tel'=>$user_tel])->first();
         $a = User::where(['user_name'=>$user_name])->first();
         $c = Code::where(['code'=>$code])->first();
         // dd($c);
        if($t){
            return json_encode(['code'=>'1','msg'=>'手机号已存在']);
        }
        if($a){
            return json_encode(['code'=>'2','msg'=>'用户名已存在']);
        }

        if(!$user_name){
           return json_encode(['code'=>'50','msg'=>'请填写用户名']);
        }
          if(!$user_tel){
           return json_encode(['code'=>'60','msg'=>'请填写手机号']);
        }
         if(!$c){
            return json_encode(['code'=>'6','msg'=>'验证码不正确']);
        }
         if(!$user_pwd){
           return json_encode(['code'=>'70','msg'=>'请输入密码']);
        }
 		  $data = [
 		  	'user_name'=>$user_name,
 		  	'user_pwd'=>password_hash($user_pwd,PASSWORD_DEFAULT),
 		  	'user_tel'=>$user_tel,
 		  	'user_time'=>$time
 		  ];
 		  $res = User::insert($data);
        if(!$res){
            return json_encode(['code'=>'4','msg'=>'注册失败']);
        }else{
            return json_encode(['code'=>'0','msg'=>'注册成功']);
        }
      }

       public function sendSMS()
    {
        $name = request()->name;
        $reg = '/^1[3|5|6|7|8|9]\d{9}$/';
        if(!preg_match($reg,$name)){
           return json_encode(['code'=>'5','msg'=>'请输入正确的手机号']);
        }
        $code = rand(10000,999999);
        // dd($code);
        $result = $this->send($name,$code);
        // dd($result);
       if($result['Message']=='OK'){
            return json_encode(['code'=>'00','msg'=>'发送成功']);
        }else{
            return json_encode(['code'=>'02','msg'=>'发送失败']);
        }

    }
    //短信验证
    public function send($name,$code){
        $k = [
            'code'=>$code
        ];
        $a = Code::insert($k);
// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md
        AlibabaCloud::accessKeyClient('LTAI4GGztP28VTaEQn9pMz9C','hY5DL4Y0iple37NwD03apfDv5XA0Ar')
            ->regionId('cn-hangzhou')
            ->asDefaultClient();
        try {
            $result = AlibabaCloud::rpc()
                ->product('Dysmsapi')
                // ->scheme('https') // https | http
                ->version('2017-05-25')
                ->action('SendSms')
                ->method('POST')
                ->host('dysmsapi.aliyuncs.com')
                ->options([
                    'query' => [
                        'RegionId' => "cn-hangzhou",
                        'PhoneNumbers' => $name,
                        'SignName' => "白洁洁",
                        'TemplateCode' => "SMS_182670126",
                        'TemplateParam' => "{code:$code}",
                    ],
                ])
                ->request();
            print_r($result->toArray());
        } catch (ClientException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        } catch (ServerException $e) {
            echo $e->getErrorMessage() . PHP_EOL;
        }
    }


    public function logindo(Request $request){
        $data= $request->all();
        $user = User::where(['user_name'=>$data['user_name']])->first();
        if(!$user){
            return json_encode(['code'=>'0002','msg'=>'账号密码错误']);
        }
        $token = jwt::instance()->setuid($user->user_id)->encode()->gettoken();
            
         return json_encode(['code'=>'0000','msg'=>'登录成功','token'=>$token,'user'=>$user]);
    }



 }

