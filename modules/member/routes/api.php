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
Route::group(['prefix'=>'member/'],function(){

    Route::group(['namespace'=>'Member\app\Http\Controllers'],function (){
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::post('refresh', 'UserController@refresh');
        Route::post('logout', 'UserController@logout');
        Route::get('', 'UserController@login')->name('login');
    });




    Route::group(['middleware'=>'auth:users-api','namespace'=>'Member\app\Http\Controllers'],function (){

        Route::group(['prefix'=>'category/'],function () {
            Route::get('{id}', 'CategoryController@get');
        });

        Route::group(['prefix'=>'plan/'],function () {
            Route::get('all', 'RoleController@all');
            Route::post('register', 'RoleController@register');
            Route::get('{id}', 'RoleController@get');
        });
    });

});

