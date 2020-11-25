<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'ekspedisi',
        'ongkir',
        'cabang_id',
        'no_resi',
    ];

    public static function getTransaksiByQuery(
        $cabangId = null,
        $transaksiId = null,
        $jenisOrder = null,
        $status = null,
        $buktiTransfer = null,
        $konsumenId = null,
        $noResi = null
    ) {
        $transaksi = DB::table('transaksi_konsumens')
            ->join('konsumens', 'konsumens.konsumen_id', '=', 'transaksi_konsumens.konsumen_id')
            ->join('alamat_pengiriman', 'alamat_pengiriman.alamat_pengiriman_id', '=', 'transaksi_konsumens.alamat_pengiriman_id')
            ->select(
                'transaksi_konsumens.*',
                'konsumens.nama_konsumen',
                'alamat_pengiriman.alamat'
            );;

        if ($cabangId) {
            $transaksi->where('cabang_id', $cabangId);
        }

        if ($transaksiId) {
            $transaksi->where('transaksi_konsumen_id', $transaksiId);
        }

        if ($jenisOrder) {
            $transaksi->where('jenis_order', $jenisOrder);
        }

        if ($status) {
            $transaksi->where('status', $status);
        }

        if ($buktiTransfer) {
            if ($buktiTransfer == 'true') {
                $transaksi->whereNotNull('bukti_transfer');
            } else {
                $transaksi->whereNull('bukti_transfer');
            }
        }

        if ($konsumenId) {
            $transaksi->where('transaksi_konsumens.konsumen_id', $konsumenId);
        }

        if ($noResi) {
            $transaksi->where('no_resi', $noResi);
        }

        return $transaksi;
    }



    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\TransaksiKonsumenDetail');
    }
}
