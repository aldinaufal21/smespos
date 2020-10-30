<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public static function getProductByQuery($namaProduk = null, $kategoriProduk = null, $idKategori = null, $produkId = null)
    {
        $produk = DB::table('produks')
                    ->join('stok_opnames', 'stok_opnames.produk_id', '=', 'produks.produk_id')
                    ->join('kategori_produks', 'kategori_produks.kategori_produk_id', '=', 'produks.kategori_produk_id')
                    ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
                    ->select(
                        'produks.*',
                        'stok_opnames.harga',
                        'kategori_produks.nama_kategori',
                        'umkms.*'
                    );


        if ($namaProduk){
            $produk->where('nama_produk', 'like', '%'.$namaProduk.'%');
        }

        if ($kategoriProduk){
            $kategoriProduk = KategoriProduk::where('nama_kategori', 'like', '%'.$kategoriProduk.'%')->first();
            $produk->where('produks.kategori_produk_id', $kategoriProduk->kategori_produk_id);
        }

        if ($idKategori){
            $produk->whereIn('produks.kategori_produk_id', $idKategori);
        }

        if ($produkId){
            $produk->where('produks.produk_id', $produkId);
        }

        return $produk->get();
    }

    public function kategori()
    {
        return $this->belongsTo('App\KategoriProduk', 'kategori_produk_id', 'kategori_produk_id');
    }

    public function produkFavorit()
    {
        return $this->hasMany('App\ProdukFavorit');
    }

    public function stokOpname()
    {
        return $this->hasMany('App\StokOpname', 'produk_id', 'produk_id');
    }

    public function stok()
    {
        return $this->hasMany('App\Stok', 'produk_id', 'produk_id');
    }

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\TransaksiKasirDetail');
    }

    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\TransaksiKonsumenDetail');
    }
}
