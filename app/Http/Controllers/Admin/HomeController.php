<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad_position;
class HomeController extends Controller
{
    // 后台首页
    public function admins(){
        return view("admin.home.admins");
    }
}
