<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKasirDetail extends Model
{
    //
    protected $primaryKey = 'id';

    protected $fillable = [
        'produk_id',
        'transaksi_kasir_id',
        'jumlah'
    ];

    public function TransaksiKasir()
    {
      return $this->belongsTo('App\TransaksiKasir');
    }
}
