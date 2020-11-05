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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/demo', function () {
    return view('demo');
})->name('demo');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('users', 'UserController')->except([
    'store', 'destroy', 'update',
]);

Route::resource('produk', 'ProdukController')->only([
    'index',
]);

Route::resource('kategori', 'KategoriProdukController')->only([
    'index',
]);

Route::resource('karyawan', 'KaryawanController')->only([
    'index',
]);

Route::resource('cabang', 'CabangController')->only([
    'index',
]);

Route::resource('kasir-cabang', 'KasirController')->only([
    'index',
]);

Route::group(['prefix' => 'kasir'], function (){
    Route::get('/', 'TransaksiKasirController@index')->name('kasir');
    Route::get('/transaksi', 'TransaksiKasirController@transaksi')->name('kasir.transaksi');
    Route::get('/transaksi-pending', 'TransaksiKasirController@pendingTransaction')->name('kasir.pending');
});

Route::get('/stok', 'StokController@stok')->name('stok');
Route::get('/stok-opname', 'StokController@stokOpname')->name('stok.opname');

Auth::routes();
