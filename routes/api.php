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
		Route::any('/udai_notice','Api\NoticeController@udai_notice');
				

		
	});
	Route::prefix('/')->group(function(){
		Route::any('details','Api\DetailsController@details');
		Route::get('/attr_key','Api\DetailsController@attr_key');

		Route::any('history','Api\DetailsController@history');//添加浏览历史记录到数据库

		Route::get('/seckill','Api\SeckillController@seckill');
		Route::get('/miaosha_show','Api\SeckillController@miaosha_show');
		Route::get('/miaosha_show_add','Api\SeckillController@miaosha_show_add');

		Route::get('/attr_keys','Api\SeckillController@attr_keys');

        Route::get('/collect','Api\DetailsController@collect');

	
	});
	Route::get('regdo','Api\TestController@regdo');//注册
	
	Route::get('regdo','Api\ApiController@regdo');//注册
	
	Route::prefix('/')->group(function(){
    Route::any('/index','Api\CartController@index');//前台购物车列表
	Route::any('/addcart','Api\CartController@addcart');//添加购物车
	Route::any('/getcartprice','Api\CartController@getcartprice');//算总价
	Route::any('/cartplus','Api\CartController@cartplus');//算数量
	Route::get("/cart/destroy/{id}","Api\CartController@destroy");//删除

	Route::any('/historys','Api\HistoryController@historys');//个人中心-浏览历史
});
	

});
Route::prefix('/goods')->group(function(){
    Route::get('/goods_list/{cate_id}','Api\GoodsController@goods_list');
});

Route::prefix('/shop')->group(function(){
	Route::get('/shopcart','Api\ShopcartController@shopcart');
	Route::get('/address','Api\ShopcartController@address');
	Route::get('/address_add','Api\ShopcartController@address_add');
	Route::get('/address_up','Api\ShopcartController@address_up');
	Route::get('/pay','Api\ShopcartController@pay');
});
// 个人中心
Route::prefix('/')->group(function(){
    Route::any('/welcome','Api\CoreorderController@welcome');
	Route::any('/udai_order','Api\CoreorderController@udai_order');
    Route::any('/udai_shopcart_pay','Api\CoreorderController@udai_shopcart_pay');
	
});

