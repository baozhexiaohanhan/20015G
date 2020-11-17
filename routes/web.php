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
    Route::get("/edit/{id}","Admin\AdController@edit");
    Route::post("/update/{id}","Admin\AdController@update");
    Route::get('/checkOnly',"Admin\AdController@checkOnly");
    //广告位
    Route::get("/position/create","Admin\PositionController@create");
    Route::post("/position/store","Admin\PositionController@store");
    Route::get("/position","Admin\PositionController@index");
    // Route::get("/position/{position_id}","Admin\PositionController@showads");
    Route::get("/position/createhtml/{position_id}","Admin\PositionController@createhtml");
    Route::get("/position/destroy/{id}","Admin\PositionController@destroy");
    Route::get("/position/edit/{id}","Admin\PositionController@edit");
    Route::post("/position/update/{id}","Admin\PositionController@update");
    Route::get("/position/change","Admin\PositionController@change");
    Route::get('/position/checkOnly',"Admin\PositionController@checkOnly");
});
Route::prefix('brand')->group(function(){
    Route::get('/create','Admin\BrandController@create')->name('brand.create');
    Route::post('/store','Admin\BrandController@store');
    Route::get('/','Admin\BrandController@index')->name('brand');
    Route::post('/upload','Admin\BrandController@upload');
    Route::get('/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');
    Route::post('/update/{brand_id}','Admin\BrandController@update');
    Route::get('/delete/{brand_id?}','Admin\BrandController@destroy');
    Route::get("/change","Admin\BrandController@change");
    Route::get('/checkOnly',"Admin\BrandController@checkOnly");
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
    Route::any('goods/type_attr','Admin\SkuController@type_attr');
    Route::any('/type','Admin\TypeController@type');
    Route::any('/type_add','Admin\TypeController@type_add');
    Route::any('/type_index','Admin\TypeController@type_index');
    Route::any('/type_del','Admin\TypeController@type_del');
    Route::any('/ajaxjdjd','Admin\TypeController@ajaxjdjd');
    Route::any('/attr/{id}','Admin\AttrController@attr');
    Route::any('/attr_add','Admin\AttrController@attr_add');
    Route::any('/attr_index/{id}','Admin\AttrController@attr_index');
    Route::any('/attr_del','Admin\AttrController@attr_del');
    



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
Route::post('/store','Admin\BirthdayController@store');

    });





