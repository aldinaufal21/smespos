<?php

namespace App\Http\Controllers;

use App\Cabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirUmkmController extends Controller
{
    public function index($umkm_id)
    {
        $cabang = Cabang::where('umkm_id', $umkm_id)->get();
        return view('kasir_umkm.kasir', compact('cabang'));
    }

    public function result(Request $request)
    {
        $id_cabang = $request->id_cabang; 
        $data = null;
        $periode = $request->periode;
        $mulai_periode = $request->mulai_periode;
        $selesai_periode = $request->selesai_periode;
        $umkm_id = $request->id_umkm;

        $cabang = Cabang::where('umkm_id', $umkm_id)->get();

        if($periode) {
            $month = date("m", strtotime($periode));
            $year = date("Y", strtotime($periode));

            $query = DB::table('transaksi_kasirs')
            ->join('kasirs', 'transaksi_kasirs.kasir_id', '=', 'kasirs.kasir_id')
            ->join('cabangs', 'kasirs.cabang_id', '=', 'cabangs.cabang_id')
            ->select('transaksi_kasirs.*')
            ->whereMonth('transaksi_kasirs.tanggal_transaksi', '=', $month)->whereYear('transaksi_kasirs.tanggal_transaksi', '=', $year)->where('cabangs.cabang_id', $id_cabang);
        }   
        else {
            $query = DB::table('transaksi_kasirs')
            ->join('kasirs', 'transaksi_kasirs.kasir_id', '=', 'kasirs.kasir_id')
            ->join('cabangs', 'kasirs.cabang_id', '=', 'cabangs.cabang_id')
            ->select('transaksi_kasirs.*')
            ->where('transaksi_kasirs.tanggal_transaksi', '>=', $mulai_periode.' 00:00:00')->where('transaksi_kasirs.tanggal_transaksi', '<=', $selesai_periode.' 23:59:59')->where('cabangs.cabang_id', $id_cabang);
        }   

        $data = $query->get();
        $total = $query->sum('transaksi_kasirs.total_harga');

        return view('kasir_umkm.kasir_result', compact('data', 'id_cabang', 'total', 'cabang', 'periode', 'mulai_periode', 'selesai_periode'));
    }
}
