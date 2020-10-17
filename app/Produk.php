<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $primaryKey = 'produk_id';

    public $timestamps = false;

    protected $fillable = [
        'nama_produk',
        'gambar_produk',
        'deskripsi_produk',
        'stok',
        'kategori_produk_id',
        'tanggal_input',
    ];

    public function kategori()
    {
        return $this->belongsTo('App\KategoriProduk');
    }

    public function produkFavorit()
    {
        return $this->hasMany('App\Models\ProdukFavorit');
    }

    public function stokOpname()
    {
        return $this->hasMany('App\Models\StokOpname');
    }

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\Models\TransaksiKasirDetail');
    }

    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\Models\TransaksiKonsumenDetail');
    }
}
