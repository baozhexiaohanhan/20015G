<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

	Route::prefix('/')->group(function(){
	Route::any('/regdo','Api\AdminController@regdo');//注册方法
	Route::any('/sendSMS','Api\AdminController@sendSMS');//发送短信验证码
	Route::any('/getuserinfo','Api\AdminController@getuserinfo');//公告
	Route::any('/logindo','Api\AdminController@logindo');//公告
	Route::any('/getuser','Api\AdminController@getuser');//公告
	Route::any('/getcurl','Api\AdminController@getcurl');//公告

 });



