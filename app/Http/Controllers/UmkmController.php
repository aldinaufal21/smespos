<?php

namespace App\Http\Controllers;

use App\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('umkm.index');
    }

    public function dataUmkm()
    {
        return view('umkm.data_umkm');
    }

    public function transaksiUmkm()
    {
        return view('umkm.transaksi');
    }

    public function dataKaryawanUmkm()
    {
        return view('umkm.karyawan');
    }

    public function dataKategoriUmkm()
    {
        return view('umkm.kategori');
    }
}
