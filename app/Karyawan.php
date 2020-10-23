<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $primaryKey = 'karyawan_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama',
        'alamat',
        'foto',
        'tanggal_bergabung',
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
}
