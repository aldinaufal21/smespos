<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

    public function wasBelongsTo($umkm)
    {
        return $this->umkm_id == $umkm->umkm_id;
    }
}
