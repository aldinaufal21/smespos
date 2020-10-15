<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Konsumen extends Model
{
    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function produkFavorit()
    {
        return $this->hasMany('App\Models\ProdukFavorit');
    }

    public function transaksiKonsumen()
    {
        return $this->hasMany('App\Models\TransaksiKonsumen');
    }
}
