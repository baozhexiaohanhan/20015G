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




Route::get('/reg','admin\LoginController@reg');//注册

<<<<<<< HEAD
Route::any('/login','admin\LoginController@login');//登录  logindo


Route::any('/logindo','admin\LoginController@logindo');//登录操作
=======
Route::get('/login','admin\LoginController@login');//首页

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
Route::any('/admin','admin\HomeController@admin');//首页
>>>>>>> d753d8a76279bda0393ff7899136817fc8400a04
