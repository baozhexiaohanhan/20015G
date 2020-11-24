<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Notice;

class NoticeController extends Controller
{
       public function udai_notice(){
        $udai_notice = Notice::where("notice_id",2)->first();
        $msg = json_encode($udai_notice);
        $data = ['code'=>400,'msgs'=>"返回成功请稍后！！",'msg'=>$msg];
        // dd($data);

        return $data;
    }
}
