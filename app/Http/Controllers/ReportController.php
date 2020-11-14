<?php

namespace App\Http\Controllers;

use App\Cabang;
use App\Report;
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

    public function downloadReport(Request $request)
    {
        $role = $request->role;

        $idUmkm = $request->umkm_id;
        $umkm = Umkm::find($idUmkm);

        $startMonth = $request->mulai_bulan ? $request->mulai_bulan : $umkm->tanggal_bergabung;
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
                        'data' => Report::getTransaksiKasirReport($idCabang, null, $m, $m)->map(function ($p) {
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
                        'data' => Report::getAllTransaksiReport($idUmkm, $m, $m)->map(function ($p) {
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
