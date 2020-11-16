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

Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法

//商品分类管理
Route::prefix('/cate')->group(function (){
    Route::get('/cateindex','Admin\cateController@cateindex');//列表展示
    Route::get('/cateadd','Admin\cateController@cateadd');//添加
    Route::post('/do_cateadd','Admin\cateController@do_cateadd');//添加执行
    Route::get('/del/{cate_id}','Admin\cateController@del');//删除
    Route::get('/update/{cate_id}','Admin\cateController@update');//修改
    Route::post('/do_update','Admin\cateController@do_update');//修改执行
});
//优惠券管理
Route::prefix('coupon')->group(function(){
    Route::get('/couponadd/','Admin\couponController@couponadd');//添加页面
    Route::post('/do_coupon/','Admin\couponController@do_coupon');//添加执行
    Route::get('/couponindex/','Admin\couponController@couponindex');//列表
    Route::get('/del/{coupon_id}','Admin\couponController@del');//删除
    Route::get('/edit/{coupon_id}','Admin\couponController@edit');//修改
    Route::post('/do_edit','Admin\couponController@do_edit');//修改执行
});