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
   		dd($res);
   		if($res['code']=='0000'){
   			Redis::hset('token'.$data['user_name'],3600,$res['token']);
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
