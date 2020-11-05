<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Produk;
use App\Stok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokController extends Controller
{
    public function index(Request $request)
    {
        $cabangId = $this->getCabang($request)->cabang_id;
        
        $produkId = $request->produk_id;
        $beforeDate = $request->sebelum_tanggal;
        $afterDate = $request->sesudah_tanggal;

        $stock = Stok::getStockByQuery($cabangId, $produkId, $beforeDate, $afterDate)->get();

        return response()->json($stock, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'stok' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['cabang_id'] = $this->getCabang($request)->cabang_id;
        $data['tanggal_input'] = Carbon::now();

        Stok::create($data);

        return response()->json($data, 201);
    }

    public function update(Request $request, $stok)
    {
        $validator = Validator::make($request->all(), [
            'stok' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['tanggal_input'] = Carbon::now();

        $stok = Stok::find($stok);
        $stok->update($data);

        return response()->json($stok, 200);
    }

    public function show(Request $request, $stokOpname)
    {
        $stokOpname = Stok::getDetailStock($stokOpname)->first();

        return response()->json($stokOpname, 200);
    }

    private function getCabang($request)
    {
        return $request->user()->cabang()->first();
    }
}
