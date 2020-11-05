<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stok extends Model
{
    protected $primaryKey = 'stok_id';

    public $timestamps = false;

    protected $fillable = [
        'stok',
        'tanggal_input',
        'produk_id',
        'cabang_id',
    ];

    public static function getStockByQuery($cabangId = null, $produkId = null, $beforeDate = null, $afterDate = null)
    {
        $stok = DB::table('stoks')
            ->join('produks', 'stoks.produk_id', '=', 'produks.produk_id')
            ->select(
                'stoks.*',
                'produks.nama_produk',
                'produks.gambar_produk',
                'produks.deskripsi_produk'
            );

        if ($produkId) {
            $stok->where('stoks.produk_id', $produkId);
        }

        if ($cabangId) {
            $stok->where('stoks.cabang_id', $cabangId);
        }

        if ($beforeDate) {
            $stok->where('stoks.tanggal_input', '<', $beforeDate);
        }

        if ($afterDate) {
            $stok->where('stoks.tanggal_input', '>', $afterDate);
        }

        $stok->orderBy('stoks.tanggal_input', 'desc');

        return $stok;
    }

    public static function getDetailStock($stokId)
    {
        return self::getStockByQuery()
            ->where('stoks.stok_id', $stokId);
    }

    public function Produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'produk_id');
    }
}
