<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function shops(){
        return view('index.shops.shops');
    }
}
