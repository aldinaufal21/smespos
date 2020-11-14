<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKonsumen extends Model
{

    protected $primaryKey = 'transaksi_konsumen_id';

    public $timestamps = false;

    protected $fillable = [
        'tanggal_transaksi',
        'konsumen_id',
        'total_biaya',
        'jenis_order',
        'status',
        'bukti_transfer',
        'catatan_order',
        'alamat_pengiriman_id',
        'bank_id',
    ];

    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\Models\TransaksiKonsumenDetail');
    }
}
