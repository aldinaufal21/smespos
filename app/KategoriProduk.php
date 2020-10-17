<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    protected $primaryKey = 'kategori_produk_id';
    
    public $timestamps = false;

    protected $fillable = [
        'nama_kategori',
        'umkm_id',
    ];

    public function umkm()
    {
        return $this->belongsTo('App\Umkm');
    }

    public function produk()
    {
        return $this->hasMany('App\Produk', 'kategori_produk_id', 'kategori_produk_id');
    }

}
