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

Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法


//角色管理
Route::prefix('/role')->group(function(){
    Route::any('/role','Admin\RoleController@role')->name('role.create');//添加
    Route::any('/roledo','Admin\RoleController@roledo')->name('role.store');//执行添加
    Route::any('/roindex','Admin\RoleController@roindex')->name('role.index');//展示
    Route::any('/rodel/{id?}','Admin\RoleController@rodel')->name('role.del');//删除
    Route::any('/roedit/{id?}','Admin\RoleController@roedit')->name('role.edit');//修改
    Route::any('/roup/{id?}','Admin\RoleController@roup')->name('role.updo');//执行修改
    Route::any('/right/{id?}','Admin\RoleController@right')->name('role.right');//角色添加权限
    Route::any('/rightdo','Admin\RoleController@rightdo')->name('role.rightdo');//执行角色添加权限
});
//权限管理
Route::prefix('/right')->group(function(){
    Route::any('/right','Admin\RightController@right')->name('right.create');//添加
    Route::any('/rigdo','Admin\RightController@rigdo')->name('right.store');//执行添加
    Route::any('/rigindex','Admin\RightController@rigindex')->name('right.index');//展示
    Route::any('/rigdel/{id?}','Admin\RightController@rigdel')->name('right.del');//删除
    Route::any('/rigedit/{id?}','Admin\RightController@rigedit')->name('right.edit');//修改
    Route::any('/rigup/{id?}','Admin\RightController@rigup')->name('right.updo');//执行修改
});


Route::prefix("/admin")->group(function(){
Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法
Route::any('/destroy/{id}','Admin\AdminController@destroy');//管理员添加方法
Route::any('/notice','Admin\AdminController@notice');//公告添加   
Route::any('/noticelist','Admin\AdminController@noticelist');//公告列表
Route::any('/createlist','Admin\AdminController@createlist');//公告添加方法

});
