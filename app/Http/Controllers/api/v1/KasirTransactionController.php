<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\TransaksiKasir;
use App\TransaksiKasirDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KasirTransactionController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'kasir_id' => 'required',
            'produk' => 'required|array|min:1',
            'produk.*.produk_id' => 'required',
            'produk.*.jumlah' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $requestData['tanggal_transaksi'] = Carbon::now();


        DB::beginTransaction();
        try {

            $order = TransaksiKasir::create($requestData);

            foreach ($requestData['produk'] as $key => $value) {
                $requestData['produk'][$key]['transaksi_kasir_id'] = $order->transaksi_kasir_id;
            }

            $orderDetail = TransaksiKasirDetail::insert($requestData['produk']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($order, 201);
    }

}
