<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKasir extends Model
{

    protected $primaryKey = 'transaksi_kasir_id';

    public $timestamps = false;

    protected $fillable = [
        'tanggal_transaksi',
        'kasir_id',
        'metode_bayar',
        'no_transaksi',
        'no_kartu'
    ];

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\TransaksiKasirDetail');
    }
}
