<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','Index\IndexController@index');//首页




Route::get('/reg','Admin\LoginController@reg');//注册
Route::any('/login','Admin\LoginController@login');//登录  logindo
Route::any('/logindo','Admin\LoginController@logindo');//登录操作
Route::get('/login','Admin\LoginController@login');//首页

//广告管理
Route::prefix("/ad")->group(function(){
	//广告位
    Route::get("/create","Admin\AdController@create");
    Route::post("/store","Admin\AdController@store");
    Route::get("/","Admin\AdController@index");
    //广告
    Route::get("/position/create","Admin\PositionController@create");
    Route::post("/position/store","Admin\PositionController@store");
    Route::get("/position","Admin\PositionController@index");
    Route::get("/position/{position_id}","Admin\PositionController@showads");
    Route::get("/position/createhtml/{position_id}","Admin\PositionController@createhtml");
});
Route::any('/admins','Admin\HomeController@admins');//首页

Route::prefix("/admin")->group(function(){

Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法
Route::any('/destroy/{id}','Admin\AdminController@destroy');//管理员添加方法
Route::any('/notice','Admin\AdminController@notice');//公告添加   
Route::any('/noticelist','Admin\AdminController@noticelist');//公告列表
Route::any('/createlist','Admin\AdminController@createlist');//公告添加方法

});
