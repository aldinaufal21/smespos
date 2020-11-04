<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cabang extends Model
{
    protected $primaryKey = 'cabang_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_cabang',
        'alamat_cabang',
        'jumlah_karyawan',
        'gambar_karyawan',
        'umkm_id',
        'user_id',
    ];

    private static function getCabang($idUmkm = null)
    {

        $cabang = DB::table('cabangs')
            ->join('umkms', 'umkms.umkm_id', '=', 'cabangs.umkm_id')
            ->join('users', 'users.id', '=', 'cabangs.user_id')
            ->select(
                'cabangs.*',
                'umkms.nama_umkm',
                'users.username'
            );

        if ($idUmkm) {
            $cabang->where('umkms.umkm_id', $idUmkm);
        }

        return $cabang;
    }

    public static function getCabangByQuery($idUmkm = null)
    {
        return self::getCabang($idUmkm)->get();
    }

    public static function getCabangById($idCabang = null)
    {
        $cabang = self::getCabang(null);

        if ($idCabang) {
            $cabang->where('cabangs.cabang_id', $idCabang);
        }

        return $cabang->first();
    }

    public function umkm()
    {
        return $this->belongsTo('App\Umkm', 'umkm_id', 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kasir()
    {
        return $this->hasMany('App\Kasir', 'cabang_id', 'cabang_id');
    }

    public function karyawan()
    {
        return $this->hasMany('App\Karyawan', 'cabang_id', 'cabang_id');
    }

    public function wasBelongsTo($umkm)
    {
        return $this->umkm_id == $umkm->umkm_id;
    }
}
