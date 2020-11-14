<?php

namespace App\Helpers;

class Helper
{
    public static function toRupiah($currency)
    {
        return "Rp " . number_format($currency,2,',','.');
    }
}
