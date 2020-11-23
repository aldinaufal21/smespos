<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class KategoriProduk extends Model
{
    protected $primaryKey = 'kategori_produk_id';

    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo('App\Umkm', 'umkm_id', 'umkm_id');
    }

    public function produk()
    {
        return $this->hasMany('App\Produk', 'kategori_produk_id', 'kategori_produk_id');
    }

    public static function getKategoriByUmkm($umkmId = null, $namaKategori = null, $cabangId = null)
    {
        $kategori = DB::table('kategori_produks')
            ->leftJoin('produks', 'produks.kategori_produk_id', '=', 'kategori_produks.kategori_produk_id')
            ->leftJoin('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->leftJoin('cabangs', 'cabangs.umkm_id', '=', 'umkms.umkm_id')
            ->select(
                DB::raw('kategori_produks.*, COUNT(distinct produks.produk_id) as total_produk')
            )
            ->groupBy('kategori_produks.kategori_produk_id')
            ->distinct();

        if ($umkmId) {
            $kategori->where('umkms.umkm_id', $umkmId);
        }

        if ($namaKategori) {
            $kategori->where('nama_kategori', 'like', '%' . $namaKategori . '%');
        }

        if ($cabangId) {
            $kategori->where('cabangs.cabang_id', $cabangId);
        }

        return $kategori->get();
    }
}
