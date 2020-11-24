<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

	Route::prefix('/')->group(function(){
	Route::any('/regdo','Api\AdminController@regdo');//注册方法
	Route::any('/sendSMS','Api\AdminController@sendSMS');//发送短信验证码
	Route::any('/getuserinfo','Api\AdminController@getuserinfo');//公告
	Route::any('/logindo','Api\AdminController@logindo');//公告
	Route::any('/getuser','Api\AdminController@getuser');//公告
	Route::any('/getcurl','Api\AdminController@getcurl');//公告


 });


Route::group(['domain' => 'www.2001api.com'], function () {
	Route::prefix('domain')->group(function(){
		Route::get('/index','Api\IndexController@index');
		Route::get('/indexa','Api\IndexController@indexa');
		Route::get('/indexb','Api\IndexController@indexb');
		Route::get('/indexc','Api\IndexController@indexc');
		Route::get('/indexd','Api\IndexController@indexd');
		Route::get('/indexe','Api\IndexController@indexe');
		Route::any('/notice','Api\IndexController@notice');
		Route::any('/fenlei','Api\IndexController@fenlei');
		Route::any('/Treecate','Api\IndexController@Treecate');
		

		
	});
	Route::prefix('/')->group(function(){
		Route::any('details','Api\DetailsController@details');
		Route::get('/attr_key','Api\DetailsController@attr_key');
	
	});
	Route::get('regdo','Api\TestController@regdo');//注册
	
	Route::get('regdo','Api\ApiController@regdo');//注册
	
	Route::prefix('/')->group(function(){
    Route::any('/index','Api\CartController@index');//前台购物车列表
	Route::any('/addcart','Api\CartController@addcart');//添加购物车
	Route::any('/getcartprice','Api\CartController@getcartprice');//算总价
	Route::any('/cartplus','Api\CartController@cartplus');//算数量
});
});
Route::prefix('/goods')->group(function(){
    Route::get('/goods_list','Api\GoodsController@goods_list');
    Route::get('/cate/{cate_id}','Api\GoodsController@cate');
    Route::get('/brand','Api\GoodsController@brand');
    Route::get('/price','Api\GoodsController@price');
});

Route::prefix('/shop')->group(function(){
    Route::get('/shopcart','Api\ShopcartController@shopcart');
});


