<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukFavorit extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'produk_id', 
        'konsumen_id', 
    ];

    protected $primaryKey = 'produk_favorit_id';

    public function konsumen()
    {
        return $this->belongsToMany('App\Konsumen', 'produk_favorits', 'produk_id', 'konsumen_id');
    }
}
