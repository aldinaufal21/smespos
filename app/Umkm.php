<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    
    protected $primaryKey = 'umkm_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_umkm', 
        'deskripsi', 
        'alamat_umkm', 
        'gambar', 
        'user_id', 
        'tanggal_bergabung', 
    ];


    public function cabang()
    {
        return $this->hasMany('App\Models\Cabang');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kategoriProduk()
    {
        return $this->hasMany('App\KategoriProduk', 'umkm_id', 'umkm_id');
    }
}
