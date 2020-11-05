<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StokOpname extends Model
{
    protected $primaryKey = 'stok_opname_id';

    public $timestamps = false;

    protected $fillable = [
        'jumlah',
        'harga',
        'tanggal_stok_opname',
        'produk_id',
        'cabang_id',
    ];

    public static function getStockOpnameByQuery($cabangId = null, $produkId = null, $beforeDate = null, $afterDate = null)
    {
        $stokOpname = DB::table('stok_opnames')
            ->join('produks', 'stok_opnames.produk_id', '=', 'produks.produk_id')
            ->select(
                'stok_opnames.*',
                'produks.nama_produk',
                'produks.gambar_produk',
                'produks.deskripsi_produk'
            );

        if ($produkId) {
            $stokOpname->where('stok_opnames.produk_id', $produkId);
        }

        if ($cabangId) {
            $stokOpname->where('stok_opnames.cabang_id', $cabangId);
        }

        if ($beforeDate) {
            $stokOpname->where('stok_opnames.tanggal_stok_opname', '<', $beforeDate);
        }

        if ($afterDate) {
            $stokOpname->where('stok_opnames.tanggal_stok_opname', '>', $afterDate);
        }

        $stokOpname->orderBy('stok_opnames.tanggal_stok_opname', 'desc');

        return $stokOpname;
    }

    public static function getDetailStockOpname($stokOpnameId)
    {
        return self::getStockOpnameByQuery()
            ->where('stok_opnames.stok_opname_id', $stokOpnameId);
    }

    public function Produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'produk_id');
    }
}
