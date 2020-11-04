<?php

namespace App\Http\Controllers;

use App\TransaksiKasir;
use Illuminate\Http\Request;

class TransaksiKasirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('kasir.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaksi()
    {
        return view('kasir.transaksi');
    }

    public function pendingTransaction()
    {
        return view('kasir.pending_transaction');
    }

}
