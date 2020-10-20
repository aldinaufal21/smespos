<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    protected $primaryKey = 'stok_opname_id';

    public $timestamps = false;

    protected $fillable = [
        'jumlah',
        'harga',
        'tanggal_stok_opname',
        'produk_id',
    ];

    public function Produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'produk_id');
    }
}
