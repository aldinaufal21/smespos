<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StokController extends Controller
{
    public function stok()
    {
        return view('produk.stok');
    }

    public function stokOpname()
    {
        return view('produk.opname');
    }
}
