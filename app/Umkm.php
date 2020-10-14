<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    //
    public function cabang()
    {
        return $this->hasMany('App\Models\Cabang');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User');
    }

    public function kategoriProduk()
    {
        return $this->hasMany('App\Models\KategoriProduk');
    }
}
