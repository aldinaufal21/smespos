<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengirimans';

    protected $primaryKey = 'pengiriman_id';

    public $timestamps = false;

    protected $fillable = [
        'ekspedisi',
        'ongkir',
        'transaksi_konsumen_id',
    ];
}
