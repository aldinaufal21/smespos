<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengelola extends Model
{
    //
    public function users()
    {
        return $this->hasOne('App\Models\User');
    }

    public function produkFavorit()
    {
        return $this->hasOne('App\Models\ProdukFavorit');
    }

    public function pendaftaranUmkm()
    {
        return $this->hasMany('App\Models\PendaftaranUmkm');
    }
}
