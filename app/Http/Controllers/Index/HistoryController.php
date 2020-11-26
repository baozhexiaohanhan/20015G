<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\History;
use App\Model\Goods;

class HistoryController extends Controller
{
    public function history(){
        $user_id=1;
        //浏览历史记录
        $user_id = 1;
        $urls = "http://www.2001api.com/historys?user_id=".$user_id;
        $history = curl_get($urls);
        // dd($history);
        $history = json_decode($history['data'],true);
        return view('index.coreorder.history',['history'=>$history]);
    }
}
