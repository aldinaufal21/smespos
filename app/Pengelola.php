<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengelola extends Model
{
    protected $primaryKey = 'pengelola_id';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_pengelola',
        'user_id',
        'login_terakhir',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pendaftaranUmkm()
    {
        return $this->hasMany('App\PendaftaranUmkm', 'pengelola_id', 'pengelola_id');
    }
}
