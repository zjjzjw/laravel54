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

//文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');

//文章创建
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts/store','\App\Http\Controllers\PostController@store');
//搜索
Route::get('/posts/search','\App\Http\Controllers\PostController@search');
//文章详情页
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');

//文章编辑
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');

//文章删除
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');

//文章图片上传
Route::post('/posts/img/upload', '\App\Http\Controllers\PostController@imgUpload');
//文章评论
Route::post('/posts/{post}/comment', '\App\Http\Controllers\PostController@comment');
//文章赞
Route::get('/posts/{post}/zan', '\App\Http\Controllers\PostController@zan');
Route::get('/posts/{post}/unzan', '\App\Http\Controllers\PostController@unzan');


//登录
Route::get('/login','\App\Http\Controllers\LoginController@index');
Route::post('/login','\App\Http\Controllers\LoginController@login');
Route::get('/logout','\App\Http\Controllers\LoginController@logout');

//注册
Route::get('/register','\App\Http\Controllers\RegisterController@index');
Route::post('/register','\App\Http\Controllers\RegisterController@register');

//个人设置
Route::get('/user/{user}/setting','\App\Http\Controllers\UserController@setting');
Route::post('/user/{user}/setting','\App\Http\Controllers\UserController@settingStore');

//个人中心
Route::get('/user/{user}','\App\Http\Controllers\UserController@show');
Route::post('/user/{user}/fan','\App\Http\Controllers\UserController@fan');
Route::post('/user/{user}/unfan','\App\Http\Controllers\UserController@unFan');