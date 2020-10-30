<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKasir extends Model
{

    protected $primaryKey = 'transaksi_kasir_id';

    public $timestamps = false;

    protected $fillable = [
        'tanggal_transaksi',
        'kasir_id'
    ];

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\Models\TransaksiKasirDetail');
    }
}
