<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShoController extends Controller
{
    public function sho(){
        return view("admin.sho");
    }
}
