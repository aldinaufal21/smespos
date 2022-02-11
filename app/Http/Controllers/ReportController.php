<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Kasir;
use App\Report;
use App\TransaksiKasir;
use App\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use DateInterval;
use DatePeriod;
use DateTime;

class ReportController extends Controller
{
    public function sales()
    {
        return view('report.sales');
    }

    public function kasir($cabang_id)
    {
        $kasir = Kasir::where('cabang_id', $cabang_id)->get();
        return view('report.kasir', compact('kasir'));
    }

    public function kasir_result(Request $request)
    {
        $id_kasir = $request->id_kasir; 
        $data = null;
        $periode = $request->periode;
        $mulai_periode = $request->mulai_periode;
        $selesai_periode = $request->selesai_periode;
        $cabang_id = $request->id_cabang;

        $kasir = Kasir::where('cabang_id', $cabang_id)->get();

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

        return view('report.kasir_result', compact('data', 'id_kasir', 'kasir', 'total', 'periode', 'mulai_periode', 'selesai_periode'));
    }

    public function downloadReport(Request $request)
    {
        $role = $request->role;

        $idUmkm = $request->umkm_id;
        $umkm = Umkm::find($idUmkm);

        $startMonth = $request->dari_bulan ? $request->dari_bulan : $umkm->tanggal_bergabung;
        $endMonth = $request->sampai_bulan ? $request->sampai_bulan : Carbon::now();

        $months = $this->getMonthBetween($startMonth, $endMonth);
        $reports = [];

        switch ($role) {
            case 'cabang':
                $idCabang = $request->cabang_id;
                $cabang = Cabang::find($idCabang);

                $reports['nama_umkm'] = $umkm->nama_umkm;
                $reports['nama_cabang'] = $cabang->nama_cabang;

                $monthlyReport = [];
                foreach ($months as $m) {
                    array_push($monthlyReport, [
                        'month' => date('m-Y', strtotime($m)),
                        'data' => Report::getTransaksiCabang($idCabang, $m, $m)->map(function ($p) {
                            return collect($p)
                                ->only(['produk_id', 'nama_produk', 'harga', 'produk_id', 'jumlah', 'total_harga', 'tanggal_transaksi',])
                                ->all();
                        }),
                        'profit' => Report::cabangMonthlyProfit($idCabang, $m, $m)->first()
                    ]);
                }
                $reports['reports'] = $monthlyReport;
                break;

            case 'umkm':
                $reports['nama_umkm'] = $umkm->nama_umkm;

                $monthlyReport = [];
                foreach ($months as $m) {
                    array_push($monthlyReport, [
                        'month' => date('m-Y', strtotime($m)),
                        'data' => Report::getTransaksiUmkm($idUmkm, $m, $m)->map(function ($p) {
                            return collect($p)
                                ->only(['produk_id', 'nama_produk', 'harga', 'produk_id', 'jumlah', 'total_harga', 'tanggal_transaksi',])
                                ->all();
                        }),
                        'profit' => Report::umkmMonthlyProfit($idUmkm, $m, $m)->first()
                    ]);
                }
                $reports['reports'] = $monthlyReport;
                break;

            default:
                # code...
                break;
        }

        // return view('report.pdf', $reports);
        $pdf = PDF::loadView('report.pdf', $reports);

        // return $pdf->download('sales_report.pdf');
        return $pdf->stream("sales_report.pdf", array("Attachment" => false));
    }

    private function getMonthBetween($startDate, $endDate)
    {
        $start    = (new DateTime($startDate))->modify('first day of this month');
        $end      = (new DateTime($endDate))->modify('last day of this month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);
        $months = [];

        foreach ($period as $dt) {
            array_push($months, $dt->format("Y-m-d"));
        }

        return $months;
    }
}
