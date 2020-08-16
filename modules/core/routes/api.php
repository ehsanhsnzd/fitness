<?php

use Illuminate\Support\Facades\Route;

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

    Route::group(['namespace'=>'Core\app\Http\Controllers'],function (){
        Route::post('register', 'AdminController@register');
        Route::post('login', 'AdminController@login');
        Route::post('refresh', 'AdminController@refresh');
        Route::post('logout', 'AdminController@logout');
        Route::get('', 'AdminController@login')->name('login');
    });

    Route::group(['middleware'=>'auth:admin-api','namespace'=>'Core\app\Http\Controllers'],function (){

        Route::group(['prefix'=>'category/'],function () {
            Route::post('', 'CategoryController@set');
            Route::put('', 'CategoryController@edit');
            Route::delete('{id}', 'CategoryController@delete');
            Route::get('{id}', 'CategoryController@get');
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

