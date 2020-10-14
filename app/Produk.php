<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    public function produkFavorit()
    {
        return $this->hasMany('App\Models\ProdukFavorit');
    }

    public function stokOpname()
    {
        return $this->hasMany('App\Models\StokOpname');
    }

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\Models\TransaksiKasirDetail');
    }

    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\Models\TransaksiKonsumenDetail');
    }
}
