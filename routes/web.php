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

Route::get('/','Index\IndexController@index');//前台首页

Route::get('/reg','Admin\LoginController@reg');//注册
Route::any('/login','Admin\LoginController@login');//登录  logindo
Route::any('/logindo','Admin\LoginController@logindo');//登录操作
Route::get('/login','Admin\LoginController@login');//首页

//防非法登录
Route::middleware('islog')->group(function(){
    Route::get('/loginapp','Admin\LoginController@loginapp');//退出
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


//品牌管理
Route::prefix('brand')->group(function(){
    Route::any('/create','Admin\BrandController@create')->name('brand.create');
    Route::any('/store','Admin\BrandController@store');
    Route::any('/','Admin\BrandController@index')->name('brand');
    Route::any('/upload','Admin\BrandController@upload');
    Route::any('/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');
    Route::any('/update/{brand_id}','Admin\BrandController@update');
    Route::any('/delete/{brand_id?}','Admin\BrandController@destroy');
    Route::any('/change','Admin\BrandController@change');
    Route::get('/checkOnly',"Admin\BrandController@checkOnly");
});
//sku 商品  类型 属性 
Route::prefix("/")->group(function(){
    Route::any('/sku','Admin\SkuController@sku');//添加商品 展示
    Route::any('goods/uploads','Admin\SkuController@uploads');//上传图片
    Route::any('goods/goods_imgdo','Admin\SkuController@goods_imgdo');//上传图片
    Route::any('goods/store','Admin\SkuController@store');//商品添加
    Route::any('goods/type_attr','Admin\SkuController@type_attr');//属性添加不用进行展示侧边
    Route::any('goods/product','Admin\SkuController@product');//货品添加不用进行展示侧边
    Route::any('goods/product_add','Admin\SkuController@product_add');//货品
    Route::any('goods/product_index','Admin\SkuController@product_index');// 商品 展示
    Route::any('goods/item_show/{id}','Admin\SkuController@item_show');//sku商品预览 展示
    Route::any('goods/attr_key','Admin\SkuController@attr_key');//计算sku商品价格
    Route::any('/type','Admin\TypeController@type');//商品类型添加 展示
    Route::any('/type_add','Admin\TypeController@type_add');//商品类型添加方法
    Route::any('/type_index','Admin\TypeController@type_index');//商品类型 展示
    Route::any('/type_del','Admin\TypeController@type_del');//商品类型删除
    Route::any('/ajaxjdjd','Admin\TypeController@ajaxjdjd');//商品类型即点即改
    Route::any('/attr/{id}','Admin\AttrController@attr');//商品属性添加
    Route::any('/attr_add','Admin\AttrController@attr_add');//商品属性添加方法
    Route::any('/attr_index/{id}','Admin\AttrController@attr_index');//商品属性展示不用进行展示侧边
    Route::any('/attr_del','Admin\AttrController@attr_del');//商品属性删除
});
Route::prefix("/")->group(function(){
    Route::any('/seckill','Admin\SeckillController@seckill');//秒杀添加展示
    Route::any('/seckill_add','Admin\SeckillController@seckill_add');//秒杀添加方法
    Route::any('/seckill_index','Admin\SeckillController@seckill_index');//秒杀展示
    Route::any('/updates/{id}','Admin\SeckillController@updates');//秒杀修改
    Route::any('/del','Admin\SeckillController@del');//秒杀删除


});


Route::any('/list','Admin\AdminController@list');//管理员列表
Route::any('/addlist','Admin\AdminController@addlist');//管理员添加   
Route::any('/create','Admin\AdminController@create');//管理员添加方法


//商品分类管理
Route::prefix('/cate')->group(function (){
    Route::get('/index','Admin\cateController@index');//列表展示
    Route::get('/create','Admin\cateController@create');//添加
    Route::post('/store','Admin\cateController@store');//添加执行
    Route::get('/destroy/{cate_id}','Admin\cateController@destroy');//删除
    Route::get('/edit/{cate_id}','Admin\cateController@edit');//修改
    Route::post('/update','Admin\cateController@update');//修改执行
});
//优惠券管理
Route::prefix('coupon')->group(function(){
    Route::get('/create/','Admin\couponController@create');//添加页面
    Route::post('/store/','Admin\couponController@store');//添加执行
    Route::get('/index/','Admin\couponController@index');//列表
    Route::get('/destroy/{coupon_id}','Admin\couponController@destroy');//删除
    Route::get('/edit/{coupon_id}','Admin\couponController@edit');//修改
    Route::post('/update','Admin\couponController@update');//修改执行
});


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

    // Route::any('/create','Admin\RegController@create')->name('admin.create');//管理员添加
    // Route::any('/rstore','Admin\RegController@rstore')->name('admin.store');//管理员执行添加
    // Route::any('/list','Admin\RegController@index')->name('admin.index');//管理员展示
    // Route::any('/delete/{brand_id}','Admin\RegController@delete')->name('admin.del');//管理员删除
    // Route::any('/redit/{admin_id}','Admin\RegController@redit')->name('admin.edit');;//管理员修改
    // Route::any('/rupdate/{admin_id}','Admin\RegController@rupdate')->name('admin.updo');;//管理员执行修改
    // Route::any('/imageCode','Admin\RegController@imageCode');
    

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

Route::get('/create','Admin\BirthdayController@create');//生日添加
Route::get('/list','Admin\BirthdayController@list');//生日列表
Route::post('/store','Admin\BirthdayController@store');

    });

});





Route::get('/reg','Index\LoginController@reg');//注册

Route::prefix('/index')->group(function(){
    Route::get('/center','Index\CouponController@center');//个人中心
    Route::get('/coupon','Index\CouponController@coupon');//优惠券
});


