<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keranjang extends Model
{
    protected $primaryKey = 'keranjang_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'produk_id',
        'konsumen_id',
        'quantity',
    ];

    public static function getKeranjangByQuery($konsumenId = null, $produkId = null)
    {
        $keranjang = DB::table('keranjangs');

        if ($konsumenId) {
            $keranjang->where('konsumen_id', $konsumenId);
        }

        if ($produkId) {
            $keranjang->where('produk_id', $produkId);
        }

        if ($keranjang->first() == null) {
            return null;
        }

        return self::find($keranjang->first()->keranjang_id);
    }

    public static function getDetailKeranjangByQuery($konsumenId = null, $produkId = null)
    {
        $keranjang = DB::table('keranjangs')
            ->join('produks', 'produks.produk_id', '=', 'keranjangs.produk_id')
            ->select('*');

        if ($konsumenId) {
            $keranjang->where('konsumen_id', $konsumenId);
        }

        if ($produkId) {
            $keranjang->where('produk_id', $produkId);
        }

        return $keranjang;
    }

    public function konsumen()
    {
        return $this->belongsTo('App\Konsumen', 'konsumen_id', 'konsumen_id');
    }

    public function produk()
    {
        return $this->hasMany('App\Produk', 'produk_id', 'produk_id');
    }
}
