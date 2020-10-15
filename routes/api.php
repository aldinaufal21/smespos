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

Route::prefix('v1')->group(function (){
    Route::post('login', 'api\v1\AuthController@login');

    Route::prefix('auth')->group(function () {
        Route::delete('reset_password/{id}', 'api\v1\AuthController@resetPassword');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        // authenticated account needed
        Route::get('logout', 'api\v1\AuthController@logout');
        Route::get('user/details', 'api\v1\AuthController@details');
    });

    Route::get('roles', 'api\v1\RoleController@index');
    Route::get('roles/{id}', 'api\v1\RoleController@show');
    Route::post('roles', 'api\v1\RoleController@store');
    Route::put('roles/{id}', 'api\v1\RoleController@update');
    Route::delete('roles/{id}', 'api\v1\RoleController@delete');

    Route::get('users', 'api\v1\UserController@index');
    Route::get('users/{id}', 'api\v1\UserController@show');
    Route::post('users', 'api\v1\UserController@store');
    Route::put('users/{id}', 'api\v1\UserController@update');
    Route::delete('users/{id}', 'api\v1\UserController@delete');

    
});
