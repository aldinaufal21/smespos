<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKonsumenDetail extends Model
{
    //
    protected $primaryKey = 'transaksi_konsumen_detail_id';

    protected $fillable = [
        'produk_id',
        'transaksi_konsumen_id',
        'jumlah'
    ];

    public function TransaksiKonsumen()
    {
      return $this->belongsTo('App\TransaksiKonsumen');
    }
}
