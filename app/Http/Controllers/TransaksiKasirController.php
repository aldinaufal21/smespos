<?php

namespace App\Http\Controllers;

use App\TransaksiKasir;
use Illuminate\Http\Request;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;

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

    public function dailyTransaction()
    {
        return view('kasir.daily_transaction');
    }

    public function report()
    {
        return view('kasir.report');
    }

    public function reportResult(Request $request)
    {
        $id_kasir = $request->id_kasir; 
        $data = null;
        $periode = $request->periode;
        $mulai_periode = $request->mulai_periode;
        $selesai_periode = $request->selesai_periode;

        if($periode) {
            $month = date("m", strtotime($periode));
            $year = date("Y", strtotime($periode));

            $query = TransaksiKasir::whereMonth('tanggal_transaksi', '=', $month)->whereYear('tanggal_transaksi', '=', $year)->where('kasir_id', $id_kasir);
        }
        else {
            $query = TransaksiKasir::where('tanggal_transaksi', '>=', $mulai_periode.' 00:00:00')->where('tanggal_transaksi', '<=', $selesai_periode.' 23:59:59')->where('kasir_id', $id_kasir);
        } 
        
        $data = $query->get();
        $total = $query->sum('total_harga');

        return view('kasir.report_result', compact('data', 'periode', 'total', 'mulai_periode', 'selesai_periode'));
    }
}
