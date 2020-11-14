<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bank extends Model
{
    protected $primaryKey = 'bank_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_bank',
        'rekening',
        'atas_nama',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo('App\Umkm', 'umkm_id', 'umkm_id');
    }

    public function wasBelongsTo($umkm)
    {
        return $this->umkm_id == $umkm->umkm_id;
    }

    public static function getBankByUmkm($umkmId = null)
    {
        $kategori = DB::table('banks')
            ->join('umkms', 'umkms.umkm_id', '=', 'banks.umkm_id')
            ->select(
                'banks.*',
            );

        if ($umkmId) {
            $kategori->where('umkms.umkm_id', $umkmId);
        }
        return $kategori->get();
    }
}
