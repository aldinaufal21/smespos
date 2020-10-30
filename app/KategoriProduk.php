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

    public static function getKategoriByUmkm($umkmId = null, $namaKategori = null)
    {
        $kategori = DB::table('kategori_produks')
            ->join('umkms', 'umkms.umkm_id', '=', 'kategori_produks.umkm_id')
            ->select(
                'kategori_produks.*',
            );

        if ($umkmId) {
            $kategori->where('umkms.umkm_id', $umkmId);
        }

        if ($namaKategori) {
            $kategori->where('nama_kategori', 'like', '%' . $namaKategori . '%');
        }

        return $kategori->get();
    }
}
