<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
use App\Helpers\jwt;
use App\Helpers\functions;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
   public function reg(){

   	return view('index.login.login');
   }

   public function log(){

   	return view('index.login.log');
   }



   public function logindo(Request $request){
   		$data['user_name'] = $request->user_name;
   		$data['user_pwd'] = $request->user_pwd;
   		$url = "http://www.2001api.com/logindo";
                $res = $this->posturl($url,$data);
                // $url = curl_get($url);   
                $info = [
                        "user_name"=>$res['user']['user_name'],
                        "user_id"=>$res['user']['user_id'],
                ];
                $user_name = $res['user']['user_name'];
   		// dd($info);
   		
   		if($res['code']=='0000'){
                           Redis::hmset('admin',$user_name,7200,$res['user']['user_id'],$res['user']['user_name'],$res['token']);
                           Cookie::queue("user_name",$user_name);
   			return json_encode($res);
   		}else{
   			return json_encode($res);
   		}
   }


    public function posturl($url,$data){

            $headerArray = [];
           // $headerArray =["Content-type:application/json;charset='utf-8'","Accept:application/json"];
            $curl = curl_init();//初始化
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST,FALSE);
            curl_setopt($curl, CURLOPT_POST, true);//设置post提交
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);//post提交表单数据
            curl_setopt($curl,CURLOPT_HTTPHEADER,$headerArray);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($curl);
           
       
       		  // $a =  curl_errno($curl);
         // dd($a);
            // echo $output;exit;
            curl_close($curl);
            return json_decode($output,true);
        }


}
