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
//sku 商品  类型 属性 
Route::prefix("/")->group(function(){
    Route::any('/sku','Admin\SkuController@sku');
    Route::any('goods/uploads','Admin\SkuController@uploads');
    Route::any('goods/goods_imgdo','Admin\SkuController@goods_imgdo');
    Route::any('goods/store','Admin\SkuController@store');
    Route::any('goods/type_attr','Admin\SkuController@type_attr');
    Route::any('goods/product','Admin\SkuController@product');
    Route::any('goods/product_add','Admin\SkuController@product_add');
    Route::any('goods/product_index','Admin\SkuController@product_index');
    Route::any('goods/item_show/{id}','Admin\SkuController@item_show');
    Route::any('goods/attr_key','Admin\SkuController@attr_key');
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
Route::prefix("/")->group(function(){
    Route::any('/seckill','Admin\SeckillController@seckill');
    Route::any('/seckill_add','Admin\SeckillController@seckill_add');
    Route::any('/seckill_index','Admin\SeckillController@seckill_index');
    Route::any('/updates/{id}','Admin\SeckillController@updates');
    Route::any('/del','Admin\SeckillController@del');

});
Route::any('/admins','Admin\HomeController@admins');//首页


Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法


//商品分类管理
Route::prefix('/cate')->group(function (){
    Route::get('/index','Admin\CateController@index');//列表展示
    Route::get('/create','Admin\CateController@create');//添加
    Route::post('/store','Admin\CateController@store');//添加执行
    Route::get('/destroy/{cate_id}','Admin\CateController@destroy');//删除
    Route::get('/edit/{cate_id}','Admin\CateController@edit');//修改
    Route::post('/update','Admin\cateController@update');//修改执行
});
//优惠券管理
Route::prefix('coupon')->group(function(){
    Route::get('/create','Admin\CouponController@create');//添加页面
    Route::post('/store','Admin\CouponController@store');//添加执行
    Route::get('/index','Admin\CouponController@index');//列表
    Route::get('/destroy/{coupon_id}','Admin\CouponController@destroy');//删除
    Route::get('/edit/{coupon_id}','Admin\CouponController@edit');//修改
    Route::post('/update','Admin\CouponController@update');//修改执行
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
Route::post('/store','Admin\BirthdayController@store');//添加方法
Route::get('/destroy/{id}','Admin\BirthdayController@destroy');//管理员添加方法

    });





Route::get('/reg','Index\LoginController@reg');//注册
