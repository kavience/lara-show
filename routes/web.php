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


include_once ('admin.php');

//
//前台

Route::group(['prefix' => '/', 'namespace'=>'Home'], function () {

    //
    //首页
    Route::get('/', 'IndexController@index')->name('/');

    //
    //个人中心
    Route::group(['prefix' => 'user'], function () {
        Route::get('/{user}', 'UserController@show')->name('user.{user}');
        Route::post('/{user}/fan', 'UserController@fan')->name('user.{user}');
        Route::post('/{user}/unfan', 'UserController@unfan')->name('user.{user}');
        Route::get('setting', 'UserController@index')->name('user.setting');
    });

    //
    //文章
    Route::group(['prefix' => 'article'], function () {
       Route::get('create', 'ArticleController@create')->name('article.create');
       Route::post('/', 'ArticleController@store')->name('article');
       Route::get('{article}', 'ArticleController@show')->name('article');
       Route::get('{article}/edit', 'ArticleController@edit')->name('article.edit');
       Route::put('/{article}', 'ArticleController@update')->name('article');
       Route::get('/{article}/delete', 'ArticleController@destroy')->name('article.{article}.delete');

       //赞和取消赞
        Route::get('/{article}/zan', 'ArticleController@zan')->name('article.{article}.zan');
        Route::get('/{article}/unzan', 'ArticleController@unzan')->name('article.{article}.unzan');
    });

    //
    //评论
    Route::group(['prefix' => 'article'], function () {
        Route::post('comment/{article}', 'CommentController@submitComment')->name('article.comment');

    });

    //
    //登录
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'LoginController@index')->name('login');
        Route::post('doLogin', 'LoginController@doLogin')->name('doLogin');
    });

    //
    //登出
    Route::get('logout', 'LoginController@logout')->name('logout');

    //
    //注册
    Route::group(['prefix' => 'register'], function () {
       Route::get('/', 'RegisterController@index')->name('Register');
       Route::post('doRegister', 'RegisterController@doRegister')->name('doRegister');
    });

    //
    //通知
    Route::group(['prefix' => 'notices'], function () {
       Route::get('/','NoticeController@index')->name('notice');
    });

    //
    //搜索
    Route::group(['prefix' => 'search'], function () {
        Route::get('/', 'SearchController@index')->name('search');
    });

    //
    //专题
    Route::group(['prefix' => 'topic'], function () {
       Route::get('/{topic}', 'TopicController@show')->name('topic/{topic}');
       Route::post('/{topic}/submit', 'TopicController@submit')->name('topic/{topic}/submit');

    });
});