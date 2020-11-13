<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function reg(){
   			echo 123;
   }

   public function login(){
   		return view('admin.admin.login');
   }
}
