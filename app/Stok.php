<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    protected $primaryKey = 'stok_id';

    public $timestamps = false;

    protected $fillable = [
        'stok',
        'tanggal_input',
        'produk_id',
    ];
}
