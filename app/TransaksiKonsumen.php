<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransaksiKonsumen extends Model
{
    //

    public function transaksiKonsumenDetail()
    {
        return $this->hasMany('App\Models\TransaksiKonsumenDetail');
    }
}
