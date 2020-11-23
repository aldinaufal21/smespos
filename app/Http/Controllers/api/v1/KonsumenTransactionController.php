<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
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
    use ImageUpload;

    public function index(Request $request)
    {
        $cabangId = null;
        $konsumenId = null;

        switch ($request->user()->role) {
            case 'konsumen':
                $konsumenId = $this->getKonsumen($request)->konsumen_id;
                break;
            case 'cabang':
                $cabangId = $this->getCabang($request)->cabang_id;
                break;
            default:
                break;
        }

        $konsumenId = $konsumenId ? $konsumenId : $request->id_konsumen;
        $transaksiId = $request->id_transaksi;
        $jenisOrder = $request->jenis_order;
        $status = $request->status;
        $buktiTransfer = $request->ada_bukti_transfer;
        $noResi = $request->no_resi;

        $transaksi = TransaksiKonsumen::getTransaksiByQuery(
            $cabangId,
            $transaksiId,
            $jenisOrder,
            $status,
            $buktiTransfer,
            $konsumenId,
            $noResi
        )->get();

        return response()->json($transaksi, 200);
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
            // 'catatan_order' => 'string',
            // 'alamat_pengiriman_id' => 'required',
            // 'bank_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $requestData['tanggal_transaksi'] = Carbon::now();


        DB::beginTransaction();
        try {
            $totalBiaya = 0;

            foreach ($requestData['produk'] as $produk) {
                $hargaProduk = Produk::find($produk['produk_id'])->harga;
                $totalBiaya += $hargaProduk * $produk['jumlah'];
            }

            $requestData['total_biaya'] = $totalBiaya;

            // $buktiTransfer = $request->bukti_transfer;
            // $urlFoto = $request->bukti_transfer != null ?
            //     $this->storeBuktiPembayaran($buktiTransfer) : null;
            // $requestData['bukti_transfer'] = $urlFoto;
            //
            // if ($urlFoto) {
            //     $requestData['status'] = 'menunggu_verifikasi';
            // }

            $requestData['status'] = 'belum_bayar';

            if ($requestData['jenis_order'] == 'take_away') {
                unset($requestData['ekspedisi']);
                unset($requestData['ongkir']);
                unset($requestData['alamat_pengiriman_id']);
            }

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

    public function statusAction(Request $request, $idTransaction)
    {
        $transaksi = TransaksiKonsumen::find($idTransaction);

        $action = $request->aksi;
        $validAction = ['diantar', 'siap diambil', 'selesai', 'dibatalkan'];

        if (!in_array($action, $validAction)) {
            return response()->json([
                'message' => 'Pilihan Aksi Salah'
            ], 400);
        }

        if ($action == 'diantar') {
            $validator = Validator::make($request->all(), [
                'no_resi' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all()
                ], 400);
            }
            $transaksi->no_resi = $request->no_resi;
        }

        $transaksi->status = $action;
        $transaksi->update();

        return response()->json($transaksi, 200);
    }

    private function getKonsumen($request)
    {
        return $request->user()->konsumen()->first();
    }

    private function getCabang($request)
    {
        return $request->user()->cabang()->first();
    }
}
