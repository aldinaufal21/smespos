<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PendaftaranUmkm extends Model
{
    public function umkm()
    {
        return $this->hasOne('App\Models\Umkm');
    }
}
