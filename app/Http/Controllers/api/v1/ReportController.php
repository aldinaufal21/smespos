<?php

namespace App\Http\Controllers\api\v1;

use App\Cabang;
use App\Http\Controllers\Controller;
use App\Produk;
use App\Report;
use App\Umkm;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportController extends Controller
{
    public function overallUmkmReport(Request $request)
    {
        # code...
    }

    public function monthlyUmkmReport(Request $request)
    {
        $idUmkm = $request->umkm_id;
        $umkm = Umkm::find($idUmkm);

        $startMonth = $request->mulai_bulan ? $request->mulai_bulan : $umkm->tanggal_bergabung;
        $endMonth = $request->sampai_bulan ? $request->sampai_bulan : Carbon::now();

        $products = Produk::getProductByQueryUmkm(null, null, null, $idUmkm)->map(function ($p) {
            return collect($p)
                ->only(['produk_id', 'nama_produk', 'nama_kategori', 'harga'])
                ->all();
        });
        $response = [];

        $months = $this->getMonthBetween($startMonth, $endMonth);

        $formattedMonths = array_map(function($m){
            return date("m-Y", strtotime($m));
        }, $months);
        
        /**
         *  product ->
         *      nama
         *      kategori
         *      harga
         *  report ->
         *      {data report}
         */

        foreach ($products as $product) {
            $reports = [];
            foreach ($months as $m) {
                array_push($reports, [
                    'month' => date("m-Y", strtotime($m)),
                    'data' => Report::getTransaksiUmkm($idUmkm, $m, $m)->map(function ($p) {
                        return collect($p)
                            ->only(['produk_id', 'nama_produk', 'harga', 'produk_id', 'jumlah', 'total_harga', 'tanggal_transaksi',])
                            ->all();
                    })->filter(function($p) use ($product){
                        return $p['produk_id'] == $product['produk_id'];
                    })->first()
                ]);
            }

            array_push($response,[
                'produk' => $product,
                'report' => $reports,
            ]);
        }

        return response()->json([
            'bulan' => $formattedMonths,
            'report_data' => $response,
        ], 200);
    }

    public function monthlyCabangReport(Request $request)
    {
        $idCabang = $request->cabang_id;
        $umkm = Cabang::find($idCabang)->umkm()->first();

        $startMonth = $request->mulai_bulan ? $request->mulai_bulan : $umkm->tanggal_bergabung;
        $endMonth = $request->sampai_bulan ? $request->sampai_bulan : Carbon::now();

        $products = Produk::getProductByQueryCabang(null, null, null, $idCabang)->map(function ($p) {
            return collect($p)
                ->only(['produk_id', 'nama_produk', 'nama_kategori', 'harga'])
                ->all();
        });
        $response = [];

        $months = $this->getMonthBetween($startMonth, $endMonth);

        $formattedMonths = array_map(function($m){
            return date("m-Y", strtotime($m));
        }, $months);
        
        /**
         *  product ->
         *      nama
         *      kategori
         *      harga
         *  report ->
         *      {data report}
         */

        foreach ($products as $product) {
            $reports = [];

            foreach ($months as $m) {
                array_push($reports, [
                    'month' => date("m-Y", strtotime($m)),
                    'data' => Report::getTransaksiCabang($idCabang, $m, $m)->map(function ($p) {
                        return collect($p)
                            ->only(['produk_id', 'nama_produk', 'harga', 'produk_id', 'jumlah', 'total_harga', 'tanggal_transaksi',])
                            ->all();
                    })->filter(function($p) use ($product){
                        return $p['produk_id'] == $product['produk_id'];
                    })->first()
                ]);
            }

            array_push($response,[
                'produk' => $product,
                'report' => $reports,
            ]);
        }

        return response()->json([
            'bulan' => $formattedMonths,
            'report_data' => $response,
        ], 200);
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
