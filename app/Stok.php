<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function Produk()
    {
        return $this->belongsTo('App\Produk', 'produk_id', 'produk_id');
    }
}
