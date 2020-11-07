<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SesiKasir extends Model
{
    //
    protected $primaryKey = 'sesi_kasir_id';

    public $timestamps = false;

    protected $fillable = [
        'waktu_mulai',
        'waktu_selesai',
        'kasir_id'
    ];

    public function kasir()
    {
      return $this->belongsTo('App\Kasir', 'kasir_id', 'kasir_id');
    }
}
