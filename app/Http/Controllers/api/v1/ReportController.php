<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Report;
use App\Umkm;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function overallUmkmReport(Type $var = null)
    {
        # code...
    }

    public function monthlyUmkmReport(Request $request)
    {
        $idUmkm = $request->umkm_id;
        $umkm = Umkm::find($idUmkm);
        
        $months = $this->getMonthBetween($umkm->tanggal_bergabung, Carbon::now());

        $response = [];
        
        foreach ($months as $m) {
            array_push($response, [
                'month' => $m,
                'report' => Report::getAllTransaksiReport($idUmkm, $m, $m)
            ]);
        }

        return response()->json($response, 200);
    }

    public function monthlyCabangReport(Request $request)
    {
        
    }

    private function getMonthBetween($startDate, $endDate)
    {
        $start    = (new DateTime($startDate))->modify('first day of this month');
        $end      = (new DateTime($endDate))->modify('first day of next month');
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($start, $interval, $end);
        $months = [];

        foreach ($period as $dt) {
            array_push($months, $dt->format("Y-m"));
        }

        return $months;
    }
}
