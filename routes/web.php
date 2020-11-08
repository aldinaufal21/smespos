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

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect('/dashboard');
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

Route::resource('umkm', 'UmkmController')->only([
    'index',
]);

Route::group(['prefix' => 'umkm'], function () {
    Route::get('/data', 'UmkmController@dataUmkm')->name('umkm.data');
    Route::get('/karyawan', 'UmkmController@dataKaryawanUmkm')->name('umkm.karyawan');
    Route::get('/kategori', 'UmkmController@dataKategoriUmkm')->name('umkm.kategori');
});

Route::group(['prefix' => 'kasir'], function (){
    Route::get('/', 'TransaksiKasirController@index')->name('kasir');
    Route::get('/transaksi', 'TransaksiKasirController@transaksi')->name('kasir.transaksi');
    Route::get('/transaksi-pending', 'TransaksiKasirController@pendingTransaction')->name('kasir.pending');
});

Route::group(['prefix' => 'report'], function (){
    Route::get('/sales', 'ReportController@sales')->name('report.sales');
});

Route::get('/stok', 'StokController@stok')->name('stok');
Route::get('/stok-opname', 'StokController@stokOpname')->name('stok.opname');

Route::get('nyoba_query', function () {
    // DB::enableQueryLog();
    // \App\Report::getTransaksiKasirReport(null, null, '2020-10-12','2020-11-12');
    // return dd(DB::getQueryLog());
    return dd(\App\Report::getAllTransaksiReport(null, '2020-11-12','2020-11-12'));
});

Route::get('/dashboard-cabang', function () {
    return view('demo');
});

Auth::routes();
