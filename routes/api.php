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

Route::group(['prefix' => 'v1', 'middleware' => ['json.response']], function () {
    Route::prefix('auth')->group(function () {
        Route::delete('reset_password', 'api\v1\AuthController@resetPassword');
    });

    Route::group(['middleware' => 'auth:api'], function () {
        // authenticated account needed
        Route::get('logout', 'api\v1\AuthController@logout');
        Route::get('user/details', 'api\v1\AuthController@details');
    
        Route::group(['prefix' => 'consumer'], function () {
            Route::post('profile/edit/', 'api\v1\KonsumenController@update');
            Route::get('profile', 'api\v1\KonsumenController@details');
        });
        
        // shipping addresses route
        Route::get('addresses', 'api\v1\ShippingAddressController@index');
        Route::get('addresses/{address}', 'api\v1\ShippingAddressController@show');
        Route::post('addresses', 'api\v1\ShippingAddressController@store');
        Route::match(['put', 'patch'], 'addresses/{address}', 'api\v1\ShippingAddressController@update');
        Route::delete('addresses/{address}', 'api\v1\ShippingAddressController@delete');

        // product categories route
        Route::get('category', 'api\v1\KategoriProdukController@index');
        Route::get('category/{category}', 'api\v1\KategoriProdukController@show');
        Route::post('category', 'api\v1\KategoriProdukController@store');
        Route::match(['put', 'patch'], 'category/{category}', 'api\v1\KategoriProdukController@update');
        Route::delete('category/{category}', 'api\v1\KategoriProdukController@delete');

        // product route
        Route::get('product', 'api\v1\ProdukController@index');
        Route::post('category/{category}/product', 'api\v1\ProdukController@store');

        // favorite product route
        Route::get('favorite-product', 'api\v1\ProdukFavoritController@index');
        Route::post('favorite-product', 'api\v1\ProdukFavoritController@store');

        // cart route
        Route::get('cart', 'api\v1\CartController@index');
        Route::post('cart', 'api\v1\CartController@store');
        Route::delete('cart/{cart}', 'api\v1\CartController@destroy');
    });

    Route::post('login', 'api\v1\AuthController@login');

    Route::post('users', 'api\v1\UserController@store');
    Route::match(['put', 'patch'],'users', 'api\v1\UserController@update');
});
