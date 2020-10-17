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

    public static function getProductByQuery($namaProduk = null, $kategoriProduk = null, $idKategori = null)
    {
        $produk = self::all();

        if ($namaProduk){
            $produk->where('nama_produk', 'like', '%'.$namaProduk.'%');
        }

        if ($kategoriProduk){
            $kategoriProduk = KategoriProduk::where('nama_kategori', 'like', '%'.$kategoriProduk.'%')->first();
            $produk->where('kategori_produk_id', $kategoriProduk->kategori_produk_id);
        }

        if ($idKategori){
            $produk->whereIn('kategori_produk_id', $idKategori);
        }

        return $produk;
    }

    public function kategori()
    {
        return $this->belongsTo('App\KategoriProduk', 'kategori_produk_id', 'kategori_produk_id');
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
