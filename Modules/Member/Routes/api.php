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

Route::group(['prefix'=>'member/'],function(){


        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::post('refresh', 'UserController@refresh');
        Route::post('logout', 'UserController@logout');
        Route::post('check', 'UserController@check');
        Route::get('', 'UserController@login')->name('login');






    Route::group(['middleware'=>'auth:users-api'],function (){

        Route::group(['prefix'=>'profile/'],function () {
            Route::post('', 'ProfileController@update');
        });

        Route::group(['prefix'=>'category/'],function () {
            Route::get('{id}', 'CategoryController@get');
            Route::get('', 'CategoryController@all');
        });

        Route::group(['prefix'=>'item/'],function () {
            Route::get('photo/{id}', 'ItemController@media');
            Route::get('file/{id}', 'ItemController@file');
            Route::get('files/{id}/{file_id}', 'ItemController@files');
            Route::get('{id}', 'ItemController@get');
        });

        Route::group(['prefix'=>'plan/'],function () {
            Route::get('', 'RoleController@current');
            Route::get('all', 'RoleController@all');
            Route::post('register', 'RoleController@register');
            Route::get('{id}', 'RoleController@get');
        });

        Route::group(['prefix'=>'dedicated/plan/'],function () {
            Route::post('', 'DedicatedPlanController@set');
            Route::put('', 'DedicatedPlanController@edit');
            Route::delete('{id}', 'DedicatedPlanController@delete');
            Route::get('{id}', 'DedicatedPlanController@get');
        });

        Route::group(['prefix'=>'personal/item/'],function () {
            Route::post('', 'PersonalItemController@set');
            Route::put('', 'PersonalItemController@edit');
            Route::delete('{id}', 'PersonalItemController@delete');
            Route::get('{id}', 'PersonalItemController@get');
        });
    });

});

