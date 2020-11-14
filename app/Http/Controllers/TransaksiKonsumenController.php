<?php

namespace App\Http\Controllers;

use App\TransaksiKonsumen;
use Illuminate\Http\Request;

class TransaksiKonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('transaksi.index');
    }
}
