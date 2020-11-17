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
    Route::any("/create","Admin\AdController@create");
    Route::any("/store","Admin\AdController@store");
    Route::any("/","Admin\AdController@index");
    Route::any('/upload','Admin\AdController@upload');
    Route::any("/destroy/{id}","Admin\AdController@destroy");
    Route::any("change","Admin\AdController@change");
    //广告位
    Route::any("/position/create","Admin\PositionController@create");
    Route::any("/position/store","Admin\PositionController@store");
    Route::any("/position","Admin\PositionController@index");
    Route::any("/position/{position_id}","Admin\PositionController@showads");
    Route::any("/position/createhtml/{position_id}","Admin\PositionController@createhtml");
    Route::any("/position/destroy/{id}","Admin\PositionController@destroy");
    Route::any("/position/edit/{id}","Admin\PositionController@edit");
    Route::any("/position/update/{id}","Admin\PositionController@update");
});
Route::prefix('brand')->group(function(){
    Route::any('/create','Admin\BrandController@create')->name('brand.create');
    Route::any('/store','Admin\BrandController@store');
    Route::any('/','Admin\BrandController@index')->name('brand');
    Route::any('/upload','Admin\BrandController@upload');
    Route::any('/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');
    Route::any('/update/{brand_id}','Admin\BrandController@update');
    Route::any('/delete/{brand_id?}','Admin\BrandController@destroy');
    Route::any('/change','Admin\BrandController@change');
});
Route::any('/admins','Admin\HomeController@admins');//后台首页

Route::prefix("/")->group(function(){
    Route::any('/sku','Admin\SkuController@sku');
    Route::any('goods/uploads','Admin\SkuController@uploads');
    Route::any('goods/goods_imgdo','Admin\SkuController@goods_imgdo');
    Route::any('goods/store','Admin\SkuController@store');
    Route::any('/type','Admin\TypeController@type');
    Route::any('/type_add','Admin\TypeController@type_add');
    Route::any('/type_index','Admin\TypeController@type_index');
    Route::any('/type_del','Admin\TypeController@type_del');



});
Route::any('/admins','Admin\HomeController@admins');//首页
//角色管理
Route::prefix("/role")->group(function(){
    Route::get('/create','Admin\RoleController@create');//角色添加
    Route::post('/store','Admin\RoleController@store');//角色列表
    Route::get('/index','Admin\RoleController@index');//角色列表
});


Route::prefix("/admin")->group(function(){
Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法
Route::get('/destroy/{id}','Admin\AdminController@destroy');//管理员添加方法
Route::any('/notice','Admin\AdminController@notice');//公告添加   
Route::any('/noticelist','Admin\AdminController@noticelist');//公告列表
Route::any('/createlist','Admin\AdminController@createlist');//公告添加方法
Route::get('/destr/{id}','Admin\AdminController@destr');//公告删除

});


Route::prefix("/birthday")->group(function(){

Route::get('/create','Admin\BirthdayController@create');//生日添加
Route::get('/list','Admin\BirthdayController@list');//生日列表
Route::post('/store','Admin\BirthdayController@store');//添加方法
Route::get('/destroy/{id}','Admin\BirthdayController@destroy');//管理员添加方法

    });

Route::get('/reg','Index\LoginController@reg');//注册
