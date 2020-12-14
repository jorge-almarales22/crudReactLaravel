<?php

use Illuminate\Http\Request;
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
Route::group(['prefix' => 'auth'], function () {
    Route::post('login','ConnectController@login');
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::post('refresh','ConnectController@refreshToken');
        Route::get('expire','ConnectController@expireToken');
    });
});

Route::group(['prefix' => 'auth'], function () {
    Route::group(['middleware' => ['jwt.auth']], function () {
        Route::get('/users', 'UserController@home')->name('user_home');
        Route::post('/users', 'UserController@user_store')->name('user_store');
        Route::post('/users/update', 'UserController@user_update')->name('user_update');
        Route::get('/users/{persona}', 'UserController@user_delete')->name('user_delete');
    });
});