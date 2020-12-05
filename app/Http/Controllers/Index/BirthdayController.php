<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Goods;
use DB;
use Illuminate\Support\Facades\Redis;

class BirthdayController extends Controller
{
    public function page(){

    	 $user_id=Redis::hmget("admin",["user_id"]);
        $user_id=implode("",$user_id);
        // return $user_id;
        if(!$user_id){
           return redirect('/log')->with('msg','请先登录！');
        }
       
    	$data = DB::table('goods')->where('is_ll',1)->paginate(10);

    	return view('index.page.page',['data'=>$data]);
    }
}
