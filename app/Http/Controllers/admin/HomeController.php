<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // 后台首页
    public function index(){
        return view("admin.home.index");
    }
}
