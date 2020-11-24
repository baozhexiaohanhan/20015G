<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Notice;

class NoticeController extends Controller
{
    public function udai_notice(Request $request){
    	$url='http://www.2001api.com/domain/udai_notice';
		$notice_id  = $request->notice_id; 
		$address = Notice::where('notice_id',$notice_id)->get();
		$notice = Notice::paginate(22);
    	 return view('index.index.udai_notice',compact('notice','address'));
    }
}
