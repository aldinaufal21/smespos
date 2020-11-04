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
        $stok = DB::table('stock')
            ->join('produks', 'stock.produk_id', '=', 'produks.produk_id')
            ->select(
                'stock.*',
                'produks.nama_produk',
                'produks.gambar_produk',
                'produks.deskripsi_produk'
            );

        if ($produkId) {
            $stok->where('stock.produk_id', $produkId);
        }

        if ($cabangId) {
            $stok->where('stock.cabang_id', $cabangId);
        }

        if ($beforeDate) {
            $stok->where('stock.tanggal_input', '<', $beforeDate);
        }

        if ($afterDate) {
            $stok->where('stock.tanggal_input', '>', $afterDate);
        }

        return $stok->get();
    }

    public function Produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'produk_id');
    }
}
