<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\TransaksiKasir;
use App\TransaksiKasirDetail;
use App\SesiKasir;
use App\Produk;
use App\Kasir;
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
            'metode_bayar' => 'required',
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
                $requestData['produk'][$key]['harga'] = Produk::getProductDetailById($value['produk_id'])->harga;
            }

            $orderDetail = TransaksiKasirDetail::insert($requestData['produk']);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? "Error ".$e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($order, 201);
    }

    public function bukaKasir(Request $request){
      $requestData = $request->all();

      $validator = Validator::make($requestData, [
          'kasir_id' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ], 400);
      }

      $requestData['waktu_mulai'] = Carbon::now();
      $requestData['waktu_selesai'] = NULL;

      DB::beginTransaction();
      try {
          $order = SesiKasir::create($requestData);
          $kasir = Kasir::where('kasir_id', $requestData['kasir_id'])->update(array(
            'status_kasir' => 'buka'
          ));

          DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
          return response()->json([
              'message' => env('APP_ENV') != 'production' ? "Error ".$e : 'Internal Server Error',
          ], 500);
      }

      return response()->json($order, 201);
    }

    public function tutupKasir(Request $request){
      $requestData = $request->all();

      $validator = Validator::make($requestData, [
          'kasir_id' => 'required',
      ]);

      if ($validator->fails()) {
          return response()->json([
              'errors' => $validator->errors()->all()
          ], 400);
      }

      $requestData['waktu_selesai'] = Carbon::now();

      DB::beginTransaction();
      try {
          $sesi = SesiKasir::where('sesi_kasir_id', $requestData['sesi_kasir_id'])->update($requestData);
          $kasir = Kasir::where('kasir_id', $requestData['kasir_id'])->update(array(
            'status_kasir' => 'tutup'
          ));

          DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
          return response()->json([
              'message' => env('APP_ENV') != 'production' ? "Error ".$e : 'Internal Server Error',
          ], 500);
      }

      return response()->json("Tutup kasir berhasil", 201);
    }

}
