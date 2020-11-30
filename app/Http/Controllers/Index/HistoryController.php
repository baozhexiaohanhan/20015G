<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\History;
use App\Model\Goods;

class HistoryController extends Controller
{
    public function history(){
        //浏览历史记录
        $urls = "http://www.2001api.com/historys";
        $history = curl_get($urls);
        // dd($history);
        $history = json_decode($history['data'],true);
        return view('index.coreorder.history',['history'=>$history]);
    }
}
