<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $primaryKey = 'kasir_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_kasir',
        'cabang_id',
        'user_id',
        'status_kasir',
    ];

    public function cabang()
    {
        return $this->belongsTo('App\Cabang', 'cabang_id', 'cabang_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function transaksiKasir()
    {
        return $this->hasMany('App\TransaksiKasir');
    }

    public function sesiKasir()
    {
        return $this->hasMany('App\SesiKasir', 'kasir_id', 'kasir_id');
    }

    public function wasBelongsTo($cabang)
    {
        return $this->cabang_id == $cabang->cabang_id;
    }
}
