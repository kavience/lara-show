<?php
/**
 * Created by PhpStorm.
 * User: kavience
 * Date: 18-3-29
 * Time: 下午9:50
 */

//后台路由
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    //使用admin中间件
    Route::group(['middleware' => 'auth:admin'], function () {
        //
        //首页
        Route::get('/', 'IndexController@index')->name('admin');

        //
        //Gate之文章管理
        Route::group(['middleware' => 'can:article'], function () {
            //
            //审核模块
            Route::group(['prefix' => 'articles'], function () {
                Route::get('/', 'ArticleController@index')->name('admin.articles');
                Route::post('/{article}/status', 'ArticleController@status')->name('admin.articles.{article}.status');
            });
        });

        //
        //Gate之系统管理
        Route::group(['middleware' => 'can:system'], function () {
            //
            //管理人员模块
            Route::group(['prefix' => 'users'], function() {
                Route::get('/', 'UserController@index')->name('admin.users');
                Route::get('/create', 'UserController@create')->name('admin.users.create');
                Route::post('/store', 'UserController@store')->name('admin.users.store');
                Route::get('/{user}/role', 'UserController@role')->name('admin.users.{user}.role');
                Route::post('/{user}/role', 'UserController@storeRole')->name('admin.users.{user}.storerole');
            });

            //
            //角色
            Route::group(['prefix' => 'roles'], function () {
                Route::get('/', 'RoleController@index')->name('admin.roles');
                Route::get('/create', 'RoleController@create')->name('admin.roles.create');
                Route::post('/store', 'RoleController@store')->name('admin.roles.store');

                Route::get('/{role}/permission', 'RoleController@permission')->name('admin.roles.{role}.permission');
                Route::post('/{role}/permission', 'RoleController@storePermission')->name('admin.roles.{role}.storePermission');

            });

            //
            //权限
            Route::group(['prefix' => 'permissions'], function () {
                Route::get('/', 'PermissionController@index')->name('admin.permissions');
                Route::get('/create', 'PermissionController@create')->name('admin.permissions.create');
                Route::post('/store', 'PermissionController@store')->name('admin.permissions.store');
            });
        });

        //
        //Gate之专题管理
        Route::group(['middleware' => 'can:topic'], function () {

            //
            //专题管理
            Route::resource('topics', '\App\Http\Controllers\Admin\TopicController', ['only'
                => ['index', 'create', 'store', 'destroy']]);
        });

        //
        //Gate之通知管理
        Route::group(['middleware' => 'can:notice'], function () {

            //
            //专题管理
            Route::resource('notices', '\App\Http\Controllers\Admin\NoticeController', ['only'
            => ['index', 'create', 'store']]);
        });
    });

    //登录
    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'LoginController@index')->name('admin.login');
        Route::post('/doLogin', 'LoginController@doLogin')->name('admin.login.doLogin');
    });

    //登出
    Route::get('logout', 'LoginController@logout')->name('admin.logout');


});