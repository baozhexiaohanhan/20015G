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




Route::get('/reg','admin\LoginController@reg');//注册

Route::any('/login','admin\LoginController@login');//登录  logindo


Route::any('/logindo','admin\LoginController@logindo');//登录操作