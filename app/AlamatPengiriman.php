<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlamatPengiriman extends Model
{
    protected $table = 'alamat_pengiriman';
        
    protected $fillable = [
        'alamat', 
        'konsumen_id', 
    ];
    
    protected $primaryKey = 'alamat_pengiriman_id';
    
    public $timestamps = false;

    public function konsumen()
    {
        return $this->belongsTo('App\Konsumen');
    }
}
