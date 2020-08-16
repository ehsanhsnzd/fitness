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
Route::group(['prefix'=>'trainer/'],function(){

    Route::group(['namespace'=>'Trainer\app\Http\Controllers'],function (){
        Route::post('register', 'UserController@register');
        Route::post('login', 'UserController@login');
        Route::post('logout', 'UserController@logout');
        Route::get('', 'UserController@login')->name('login');
    });

    Route::group(['middleware'=>'auth:trainer','namespace'=>'Category\app\Http\Controllers'],function (){

        Route::group(['prefix'=>'category/'],function () {
            Route::get('{id}', 'CategoryController@get');
        });

        Route::group(['prefix'=>'plan/'],function () {
            Route::get('all', 'RoleController@all');
            Route::post('', 'RoleController@assign');
            Route::get('{id}', 'RoleController@get');
        });
    });

});

