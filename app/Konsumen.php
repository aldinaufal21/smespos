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
        'tanggal_gabung',
        'user_id' 
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
        return $this->belongsToMany('App\Produk', 'produk_favorits', 'konsumen_id', 'produk_id');
    }

    public function keranjang()
    {
        return $this->hasMany('App\Keranjang', 'konsumen_id', 'konsumen_id');
    }

    public function transaksiKonsumen()
    {
        return $this->hasMany('App\TransaksiKonsumen');
    }
}
