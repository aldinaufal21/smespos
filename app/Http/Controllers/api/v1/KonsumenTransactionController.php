<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Pengiriman;
use App\Produk;
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
        /**
         * TODO
         */
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'konsumen_id' => 'required',
            'produk' => 'required|array|min:1',
            'produk.*.produk_id' => 'required',
            'produk.*.jumlah' => 'required',
            'jenis_order' => 'required',
            'catatan_order' => 'string',
            'alamat_pengiriman_id' => 'required',
            'bank_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $requestData['tanggal_transaksi'] = Carbon::now();


        DB::beginTransaction();
        try {
            /**
             * (-) status
             * (-) bukti_transfer
             */
            $totalBiaya = 0;

            foreach ($requestData['produk'] as $produk) {
                $hargaProduk = Produk::find($produk['produk_id'])->harga;
                $totalBiaya += $hargaProduk * $produk['jumlah'];
            }
            
            $requestData['total_biaya'] = $totalBiaya;

            $order = TransaksiKonsumen::create($requestData);

            foreach ($requestData['produk'] as $key => $value) {
                $requestData['produk'][$key]['transaksi_konsumen_id'] = $order->transaksi_konsumen_id;
            }

            $orderDetail = TransaksiKonsumenDetail::insert($requestData['produk']);

            if ($requestData['jenis_order']) {
                $requestData['transaksi_konsumen_id'] = $order->transaksi_konsumen_id;
                $pengiriman = Pengiriman::create($requestData);
            }

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
