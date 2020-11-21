<?php

namespace App\Http\Controllers;

use App\Pengelola;
use Illuminate\Http\Request;

class PengelolaController extends Controller
{
    public function routeKategori()
    {
        return view('specific_pengelola_pages.route_kategori');
    }

    public function routeProduk()
    {
        return view('specific_pengelola_pages.route_produk');
    }
}
