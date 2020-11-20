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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();


});


Route::prefix('domain')->group(function(){
	Route::get('/index','Api\IndexController@index');
	Route::get('/indexa','Api\IndexController@indexa');
	Route::get('/indexb','Api\IndexController@indexb');
	Route::get('/indexc','Api\IndexController@indexc');
	Route::get('/indexd','Api\IndexController@indexd');
	Route::get('/indexe','Api\IndexController@indexe');
});
Route::get('regdo','Api\TestController@regdo');//注册

Route::get('regdo','Api\ApiController@regdo');//注册



