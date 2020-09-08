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

Route::group(['prefix'=>'admin/'],function (){

        Route::post('register', 'AdminController@register');
        Route::post('login', 'AdminController@login');
        Route::post('refresh', 'AdminController@refresh');
        Route::post('logout', 'AdminController@logout');
        Route::get('', 'AdminController@login')->name('login');

    Route::group(['middleware'=>'auth:admin-api'],function (){

        Route::group(['prefix'=>'base-setting/'],function () {
            Route::post('', 'BaseSettingController@set');
            Route::put('', 'BaseSettingController@edit');
            Route::delete('{id}', 'BaseSettingController@delete');
            Route::get('{id}', 'BaseSettingController@get');
            Route::get('slug/{id}', 'BaseSettingController@getSlug');
            Route::get('', 'BaseSettingController@all');
        });

        Route::group(['prefix'=>'setting/'],function () {
            Route::post('', 'SettingController@set');
            Route::put('', 'SettingController@edit');
            Route::delete('{id}', 'SettingController@delete');
            Route::get('{id}', 'SettingController@get');
            Route::get('slug/{id}', 'SettingController@getSlug');
        });

        Route::group(['prefix'=>'category/'],function () {
            Route::post('', 'CategoryController@set');
            Route::put('', 'CategoryController@edit');
            Route::post('upload', 'CategoryController@upload');
            Route::delete('{id}', 'CategoryController@delete');
            Route::get('{id}', 'CategoryController@get');
            Route::get('', 'CategoryController@all');

        });

        Route::group(['prefix'=>'item/'],function () {
            Route::post('', 'ItemController@set');
            Route::post('edit', 'ItemController@edit');
            Route::delete('{id}', 'ItemController@delete');
            Route::get('{id}', 'ItemController@get');
            Route::get('', 'ItemController@all');
        });

        Route::group(['prefix'=>'plan/'],function () {
            Route::get('', 'RoleController@all');
            Route::post('', 'RoleController@set');
            Route::put('', 'RoleController@edit');
            Route::post('trainer/assign', 'RoleController@assign');
            Route::delete('{id}', 'RoleController@delete');
            Route::get('{id}', 'RoleController@get');
        });
    });

});

