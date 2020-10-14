<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKasir extends Model
{
    //

    public function transaksiKasirDetail()
    {
        return $this->hasMany('App\Models\TransaksiKasirDetail');
    }
}
