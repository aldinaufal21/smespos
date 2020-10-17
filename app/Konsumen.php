<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'nama_konsumen', 
        'alamat_konsumen', 
        'nomor_hp', 
        'gambar', 
        'login_terakhir', 
    ];

    protected $primaryKey = 'konsumen_id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function alamatPengiriman()
    {
        return $this->hasMany('App\AlamatPengiriman', 'konsumen_id', 'konsumen_id');
    }

    public function produkFavorit()
    {
        return $this->hasMany('App\ProdukFavorit');
    }

    public function transaksiKonsumen()
    {
        return $this->hasMany('App\TransaksiKonsumen');
    }
}
