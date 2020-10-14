<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{

    public function kasir()
    {
        return $this->hasMany('App\Models\Kasir');
    }
}
