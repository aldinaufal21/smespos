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

Route::get('/demo', function () {
    return view('demo');
})->name('demo');

Route::get('/', 'KonsumenController@index')->name('konsumen.home');
Route::get('/login', 'KonsumenController@login')->name('konsumen.login');
Route::get('/register', 'KonsumenController@register')->name('konsumen.register');
Route::get('/checkout', 'KonsumenController@checkout')->name('konsumen.checkout');
Route::get('/payment', 'KonsumenController@pembayaran')->name('konsumen.pembayaran');
Route::get('/contact-us', 'KonsumenController@contact')->name('konsumen.contact');
Route::post('/contact-us', 'KonsumenController@contact');

Route::group(['prefix' => 'user'], function () {
  Route::get('/', 'KonsumenController@profile')->name('konsumen.profile');
  Route::get('/wishlist', 'KonsumenController@wishlist')->name('konsumen.wishlist');

  Route::get('/change_password', 'UserController@changePassword')->name('user.change_password');
  Route::get('/settings', 'UserController@accountSettings')->name('user.account_settings');
});

Route::group(['prefix' => 'shop'], function () {
  Route::get('/', 'KonsumenController@shop')->name('konsumen.shop');
  Route::get('/produk', function () {
      return view('konsumen_app.shop.produk');
  })->name('konsumen.produk');
});

Route::get('/cart', 'KonsumenController@cart')->name('konsumen.cart');

Route::group(['prefix' => 'admin'], function () {

    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });

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

    Route::resource('bank', 'BankController')->only([
        'index',
    ]);

    Route::resource('umkm', 'UmkmController')->only([
        'index',
    ]);

    Route::resource('transaksi', 'TransaksiKonsumenController')->only([
        'index',
    ]);

    Route::group(['prefix' => 'umkm'], function () {
        Route::get('/data', 'UmkmController@dataUmkm')->name('umkm.data');
        Route::get('/transaksi', 'UmkmController@transaksiUmkm')->name('umkm.transaksi');
        Route::get('/karyawan', 'UmkmController@dataKaryawanUmkm')->name('umkm.karyawan');
        Route::get('/kategori', 'UmkmController@dataKategoriUmkm')->name('umkm.kategori');
        Route::get('/profil', 'UmkmController@profil')->name('umkm.profil');
    });

    Route::group(['prefix' => 'kasir'], function () {
        Route::get('/', 'TransaksiKasirController@index')->name('kasir');
        Route::get('/transaksi', 'TransaksiKasirController@transaksi')->name('kasir.transaksi');
        Route::get('/transaksi-pending', 'TransaksiKasirController@pendingTransaction')->name('kasir.pending');
        Route::get('/transaksi-harian', 'TransaksiKasirController@dailyTransaction')->name('kasir.daily');
        Route::get('/laporan', 'TransaksiKasirController@report')->name('kasir.report');
        Route::post('/laporan/result', 'TransaksiKasirController@reportResult')->name('kasir.report_result');
    });

    Route::group(['prefix' => 'kasir_umkm'], function()
    {
        Route::get('laporan/{id_umkm}', 'KasirUmkmController@index')->name('kasir_umkm.kasir');
        Route::post('laporan/result', 'KasirUmkmController@result')->name('kasir_umkm.kasir_result');
    });

    Route::group(['prefix' => 'report'], function () {
        Route::get('/sales', 'ReportController@sales')->name('report.sales');
        Route::get('/kasir/{id_cabang}', 'ReportController@kasir')->name('report.kasir');
        Route::post('/kasir/result', 'ReportController@kasir_result')->name('report.kasir_result');
        Route::post('/download', 'ReportController@downloadReport')->name('report.download');
    });

    Route::get('/stok', 'StokController@stok')->name('stok');
    Route::get('/stok-opname', 'StokController@stokOpname')->name('stok.opname');

    Route::get('/route-kategori', 'PengelolaController@routeKategori')->name('route.kategori');
    Route::get('/route-produk', 'PengelolaController@routeProduk')->name('route.produk');

    Route::get('/dashboard-pengelola', function () {
        return view('demo');
    });

    Route::get('/dashboard-umkm', function () {
        return view('demo');
    });

    Route::get('/dashboard-cabang', function () {
        return view('demo');
    });

    Route::get('/dashboard-pengelola', function () {
        return view('demo');
    });

    Route::get('/phpinfo', function () {
        phpinfo();
    });

    Route::get('/test-print/{id_transaksi}', 'api\v1\KasirTransactionController@printReceipt');
    Route::get('/test-query', 'api\v1\KasirTransactionController@testQuery');

    Auth::routes();
});

Route::get('nyoba_query', function () {
    DB::enableQueryLog();
    \App\Produk::getProductByQueryCabang(null, null, null, 1);
    return dd(DB::getQueryLog());
});

Route::get('hasil_query', function () {
    return dd(\App\Produk::getProductByQueryCabang(null, null, null, 1));
});

// Route::get('/{any?}', 'KonsumenAppController@index')->where('any', '(.*)');
