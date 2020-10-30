<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\TransaksiKonsumen;
use App\TransaksiKonsumenDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KonsumenTransactionController extends Controller
{
    public function index(Request $request)
    {

    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'konsumen_id' => 'required',
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

            $order = TransaksiKonsumen::create($requestData);

            foreach ($requestData['produk'] as $key => $value) {
                $requestData['produk'][$key]['transaksi_konsumen_id'] = $order->transaksi_konsumen_id;
            }

            $orderDetail = TransaksiKonsumenDetail::insert($requestData['produk']);

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
