<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftaranUmkm extends Model
{
    protected $primaryKey = 'pendaftaran_umkm_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_pendaftaran',
        'no_ktp',
        'umkm_id',
        'pengelola_id',
        'tanggal_pendaftaran',
    ];
    
    public function scopeApproved($query)
    {
        return $query->where('status_pendaftaran', 'approved');
    }
    
    public function scopePending($query)
    {
        return $query->where('status_pendaftaran', 'pending');
    }

    public function umkm()
    {
        return $this->belongsTo('App\Umkm', 'umkm_id', 'umkm_id');
    }

    public function pengelola()
    {
        return $this->belongsTo('App\Pengelola', 'pengelola_id', 'pengelola_id');
    }
}
