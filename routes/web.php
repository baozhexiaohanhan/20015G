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
Route::prefix("ad")->group(function(){
	//广告
    Route::get("/create","Admin\AdController@create");
    Route::post("/store","Admin\AdController@store");
    Route::get("/","Admin\AdController@index");
    Route::post('/upload','Admin\AdController@upload');
    Route::get("/destroy/{id}","Admin\AdController@destroy");
    Route::get("change","Admin\AdController@change");
    //广告位
    Route::get("/position/create","Admin\PositionController@create");
    Route::post("/position/store","Admin\PositionController@store");
    Route::get("/position","Admin\PositionController@index");
    Route::get("/position/{position_id}","Admin\PositionController@showads");
    Route::get("/position/createhtml/{position_id}","Admin\PositionController@createhtml");
    Route::get("/position/destroy/{id}","Admin\PositionController@destroy");
    Route::get("/position/edit/{id}","Admin\PositionController@edit");
    Route::post("/position/update/{id}","Admin\PositionController@update");
});
Route::prefix('brand')->group(function(){
    Route::get('/create','Admin\BrandController@create')->name('brand.create');
    Route::post('/store','Admin\BrandController@store');
    Route::get('/','Admin\BrandController@index')->name('brand');
    Route::post('/upload','Admin\BrandController@upload');
    Route::get('/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');
    Route::post('/update/{brand_id}','Admin\BrandController@update');
    Route::get('/delete/{brand_id?}','Admin\BrandController@destroy');
    Route::get('/change','Admin\BrandController@change');
});
Route::any('/admins','Admin\HomeController@admins');//首页
