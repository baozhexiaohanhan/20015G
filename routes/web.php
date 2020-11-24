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

Route::get('/','Index\IndexController@index')->name('.index');//前台首页



Route::get('/reg','Admin\LoginController@reg')->name('reg');//后台注册
Route::any('/login','Admin\LoginController@login')->name('login');//后台登录  logindo
Route::any('/logindo','Admin\LoginController@logindo')->name('logindo');//后台登录操作
//防非法登录
Route::middleware('islog')->group(function(){

    Route::any('/admins','Admin\HomeController@admins')->name('aindex');//后台首页
    Route::get('/loginapp','Admin\LoginController@loginapp')->name('loginapp');//退出

//广告管理
Route::prefix("/ad")->group(function(){
	//广告
    Route::get("/create","Admin\AdController@create")->name('ad.create');//广告添加
    Route::post("/store","Admin\AdController@store")->name('ad.store');//广告执行添加
    Route::get("/","Admin\AdController@index")->name('ad.index');//广告列表
    Route::post('/upload','Admin\AdController@upload')->name('ad.upload');//广告图片
    Route::get("/destroy/{id}","Admin\AdController@destroy")->name('ad.destroy');//广告删除
    Route::get("change","Admin\AdController@change")->name('ad.change');//广告即点即改
    Route::get("/edit/{id}","Admin\AdController@edit")->name('ad.edit');//广告修改
    Route::post("/update/{id}","Admin\AdController@update")->name('ad.update');//广告执行修改
    Route::get('/checkOnly',"Admin\AdController@checkOnly")->name('ad.checkOnly');//广告js验证
    //广告位
    Route::get("/position/create","Admin\PositionController@create")->name('ad.position.create');//广告位添加
    Route::post("/position/store","Admin\PositionController@store")->name('ad.position.store');//广告位执行添加
    Route::get("/position","Admin\PositionController@index")->name('ad.position');//广告位展示
    Route::get("/position/createhtml/{position_id}","Admin\PositionController@createhtml")->name('ad.position.createhtml');//广告位生成
    Route::get("/position/destroy/{id}","Admin\PositionController@destroy")->name('ad.position.destroy');//广告位删除
    Route::get("/position/edit/{id}","Admin\PositionController@edit")->name('ad.position.edit');//广告位修改
    Route::post("/position/update/{id}","Admin\PositionController@update")->name('ad.position.update');//广告位执行修改
    Route::get("/position/change","Admin\PositionController@change")->name('ad.position.change');//广告位即点即改
    Route::get('/position/checkOnly',"Admin\PositionController@checkOnly")->name('ad.position.checkOnly');//广告位js验证
});

//品牌管理
Route::prefix('/brand')->group(function(){
    Route::any('/create','Admin\BrandController@create')->name('brand.create');//品牌添加
    Route::any('/store','Admin\BrandController@store')->name('brand.store');//品牌执行添加
    Route::any('/','Admin\BrandController@index')->name('brand.index');//品牌展示
    Route::any('/upload','Admin\BrandController@upload')->name('brand.upload');//品牌图片
    Route::any('/edit/{brand_id}','Admin\BrandController@edit')->name('brand.edit');//品牌修改
    Route::any('/update/{brand_id}','Admin\BrandController@update')->name('brand.update');//品牌执行修改
    Route::any('/delete/{brand_id?}','Admin\BrandController@destroy')->name('brand.destroy');//品牌删除
    Route::any('/change','Admin\BrandController@change')->name('brand.change');//品牌即点即改
    Route::get('/checkOnly',"Admin\BrandController@checkOnly")->name('brand.checkOnly');//品牌js验证
});
//sku 商品  类型 属性 
Route::prefix("/")->group(function(){
    Route::any('/sku','Admin\SkuController@sku')->name('.sku');//添加商品 展示
    Route::any('/goods/uploads','Admin\SkuController@uploads')->name('goods.uploads');//上传图片
    Route::any('/goods/goods_imgdo','Admin\SkuController@goods_imgdo')->name('goods.goods_imgdo');//上传图片
    Route::any('/goods/store','Admin\SkuController@store')->name('goods.store');//商品执行添加
    Route::any('/goods/type_attr','Admin\SkuController@type_attr')->name('goods.type_attr');//属性添加不用进行展示侧边
    Route::any('/goods/product','Admin\SkuController@product')->name('goods.product');//货品添加不用进行展示侧边
    Route::any('/goods/product_add','Admin\SkuController@product_add')->name('goods.product_add');//货品
    Route::any('/goods/product_index','Admin\SkuController@product_index')->name('goods.product_index');// 商品 展示
    Route::any('/goods/item_show/{id}','Admin\SkuController@item_show')->name('goods.item_show');//sku商品预览 展示
    Route::any('/goods/attr_key','Admin\SkuController@attr_key')->name('goods.attr_key');//计算sku商品价格
    Route::any('/type','Admin\TypeController@type')->name('.type');//商品类型添加 展示
    Route::any('/type_add','Admin\TypeController@type_add')->name('.type_add');//商品类型添加方法
    Route::any('/type_index','Admin\TypeController@type_index')->name('.type_index');//商品类型 展示
    Route::any('/type_del','Admin\TypeController@type_del')->name('.type_del');//商品类型删除
    Route::any('/ajaxjdjd','Admin\TypeController@ajaxjdjd')->name('.ajaxjdjd');//商品类型即点即改
    Route::any('/attr/{id}','Admin\AttrController@attr')->name('.attr');//商品属性添加
    Route::any('/attr_add','Admin\AttrController@attr_add')->name('.attr_add');//商品属性添加方法
    Route::any('/attr_index/{id}','Admin\AttrController@attr_index')->name('.attr_index');//商品属性展示不用进行展示侧边
    Route::any('/attr_del','Admin\AttrController@attr_del')->name('.attr_del');//商品属性删除
});

// 秒杀管理
Route::prefix("/")->group(function(){
    Route::any('/seckill','Admin\SeckillController@seckill')->name('.seckill');//秒杀添加展示
    Route::any('/seckill_add','Admin\SeckillController@seckill_add')->name('.seckill_add');//秒杀添加方法
    Route::any('/seckill_index','Admin\SeckillController@seckill_index')->name('.seckill_index');//秒杀展示
    Route::any('/updates/{id}','Admin\SeckillController@updates')->name('.updates');//秒杀修改
    Route::any('/del','Admin\SeckillController@del')->name('.del');//秒杀删除
    Route::any('/seckill_jia','Admin\SeckillController@seckill_jia')->name('.seckill_jia');//秒杀删除
});

//商品分类管理
Route::prefix('/cate')->group(function (){
    Route::get('/index','Admin\cateController@index')->name('cate.index');//列表展示
    Route::get('/create','Admin\cateController@create')->name('cate.create');//添加
    Route::post('/store','Admin\cateController@store')->name('cate.store');//添加执行
    Route::get('/destroy/{cate_id}','Admin\cateController@destroy')->name('cate.destroy');//删除
    Route::get('/edit/{cate_id}','Admin\cateController@edit')->name('cate.edit');//修改
    Route::post('/update','Admin\cateController@update')->name('cate.update');//修改执行
});
//优惠券管理
Route::prefix('/coupon')->group(function(){
    Route::get('/create','Admin\couponController@create')->name('coupon.create');//添加页面
    Route::post('/store','Admin\couponController@store')->name('coupon.store');//添加执行
    Route::get('/index','Admin\couponController@index')->name('coupon.index');//列表
    Route::get('/destroy/{coupon_id}','Admin\couponController@destroy')->name('coupon.destroy');//删除
    Route::get('/edit/{coupon_id}','Admin\couponController@edit')->name('coupon.edit');//修改
    Route::post('/update','Admin\couponController@update')->name('coupon.update');//修改执行
});


//角色管理
Route::prefix('/role')->group(function(){
    Route::any('/role','Admin\RoleController@role')->name('role.role');//添加
    Route::any('/roledo','Admin\RoleController@roledo')->name('role.roledo');//执行添加
    Route::any('/roindex','Admin\RoleController@roindex')->name('role.roindex');//展示
    Route::any('/rodel/{id?}','Admin\RoleController@rodel')->name('role.rodel');//删除
    Route::any('/roedit/{id?}','Admin\RoleController@roedit')->name('role.roedit');//修改
    Route::any('/roup/{id?}','Admin\RoleController@roup')->name('role.roup');//执行修改
    Route::any('/right/{id?}','Admin\RoleController@right')->name('role.right');//角色添加权限
    Route::any('/rightdo','Admin\RoleController@rightdo')->name('role.rightdo');//执行角色添加权限
});
//权限管理
Route::prefix('/right')->group(function(){
    Route::any('/right','Admin\RightController@right')->name('right.right');//添加
    Route::any('/rigdo','Admin\RightController@rigdo')->name('right.rigdo');//执行添加
    Route::any('/rigindex','Admin\RightController@rigindex')->name('right.rigindex');//展示
    Route::any('/rigdel/{id?}','Admin\RightController@rigdel')->name('right.rigdel');//删除
    Route::any('/rigedit/{id?}','Admin\RightController@rigedit')->name('right.rigedit');//修改
    Route::any('/rigup/{id?}','Admin\RightController@rigup')->name('right.rigup');//执行修改
});

//管理员管理
Route::prefix("/admin")->group(function(){
    Route::any('/list','Admin\AdminController@list')->name('admin.list');//管理员列表
    Route::any('/addlist','Admin\AdminController@addlist')->name('admin.addlist');//管理员添加   
    Route::any('/create','Admin\AdminController@create')->name('admin.create');//管理员添加方法
    Route::get('/destroy/{id}','Admin\AdminController@destroy')->name('admin.destroy');//管理员删除
    Route::any('/notice','Admin\AdminController@notice')->name('admin.notice');//公告添加   
    Route::any('/noticelist','Admin\AdminController@noticelist')->name('admin.noticelist');//公告列表
    Route::any('/createlist','Admin\AdminController@createlist')->name('admin.createlist');//公告添加方法
    Route::get('/destr/{id}','Admin\AdminController@destr')->name('admin.destr');//公告删除
});

// 生日管理
Route::prefix("/birthday")->group(function(){
    Route::get('/create','Admin\BirthdayController@create')->name('birthday.create');//生日添加
    Route::get('/list','Admin\BirthdayController@list')->name('birthday.list');//生日列表
    Route::post('/store','Admin\BirthdayController@store')->name('birthday.store');//生日执行添加
});

});



//购物车
Route::get('/addcart','Index\CartController@addcart');//添加购物车
Route::get('/cart','Index\CartController@index');//前台购物车列表
Route::get('/getcartprice','Index\CartController@getcartprice');//算总价
Route::get('/cartplus','Index\CartController@cartplus');//算数量



Route::get('/reg','Index\LoginController@reg');//注册
Route::get('/log','Index\LoginController@log');//注册
Route::get('/logindo','Index\LoginController@logindo');//注册

Route::prefix('/index')->group(function(){
    Route::get('/center','Index\CouponController@center');//个人中心
    Route::get('/coupon','Index\CouponController@coupon');//优惠券

});

Route::prefix('/goods')->group(function(){
    Route::get('/goods_list/{cate_id}','Index\GoodsController@goods_list');
});


Route::prefix('/')->group(function(){
    Route::any('/details','Index\DetailsController@details');
    Route::any('rush/seckill','Index\SeckillController@seckill');
    

});


Route::get('/shopcart','Index\ShopcartController@shopcart');
 
