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
/**
 * not yet used routes
//konsumen
Route::get('/konsumen/transaksi/history', 'TransaksiKonsumenControllers@history');
Route::get('/konsumen/transaksi/status', 'TransaksiKonsumenControllers@status');
Route::get('/konsumen/transaksi/batal', 'TransaksiKonsumenControllers@batalkan');

Route::get('/produk/daftar', 'ProdukControllers@index');
Route::get('/produk/cari', 'ProdukControllers@search');
Route::get('/produk/tambah-ke-keranjang', 'ProdukControllers@tambahKeKerangjang');

Route::get('/keranjang/index', 'TransaksiKonsumenControllers@daftarBelanja');
Route::get('/keranjang/hapus', 'TransaksiKonsumenControllers@hapusBarang');
Route::get('/keranjang/checkout', 'TransaksiKonsumenControllers@checkout');
Route::get('/keranjang/bayar', 'TransaksiKonsumenControllers@bayar');

//umkm
Route::get('/kasir/buka-kasir', 'KasirControllers@bukaKasir');
Route::get('/kasir/tutup-kasir', 'KasirControllers@tutupKasir');
Route::get('/kasir/simpan-transaksi', 'KasirControllers@simpanTransaksi');
Route::get('/kasir/batalkan-transaksi', 'KasirControllers@batalkanTransaksi');
Route::get('/kasir/tunda-transaksi', 'KasirControllers@tundaTransaksi');

Route::get('/produk/tambah', 'ProdukControllers@tambahProduk');
Route::get('/produk/edit', 'ProdukControllers@editProduk');
Route::get('/produk/hapus', 'ProdukControllers@hapusProduk');
Route::get('/produk/index', 'ProdukControllers@daftarProduk');

Route::get('/kategori_produk/tambah', 'KategoriProdukControllers@tambahKategoriProduk');
Route::get('/kategori_produk/index', 'KategoriProdukControllers@daftarKategoriProduk');
Route::get('/kategori_produk/edit', 'KategoriProdukControllers@editKategoriProduk');
Route::get('/kategori_produk/hapus', 'KategoriProdukControllers@hapusKategoriProduk');

Route::get('/karyawan/tambah', 'KaryawanControllers@tambahKaryawan');
Route::get('/karyawan/daftar', 'KaryawanControllers@daftarKaryawan');
Route::get('/karyawan/edit', 'KaryawanControllers@editKaryawan');
Route::get('/karyawan/hapus', 'KaryawanControllers@hapusKaryawan');

Route::get('/laporan/cetak', 'TransaksiKasirControllers@cetakLaporan');
Route::get('/laporan/cetak', 'TransaksiKasirControllers@generateLaporan');
*/

Route::get('/demo', function () {
    return view('demo');
})->name('demo');

Route::get('/dashboard', 'DashboardController@index');

Route::resource('users', 'UserController')->except([
    'store', 'destroy', 'update',
]);

Auth::routes();
