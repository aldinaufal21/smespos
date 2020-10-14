<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    public function transaksiKasir()
    {
        return $this->hasMany('App\Models\TransaksiKasir');
    }
}
