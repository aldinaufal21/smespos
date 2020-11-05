<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\StokOpname;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokOpnameController extends Controller
{
    public function index(Request $request)
    {
        $cabangId = $this->getCabang($request)->cabang_id;

        $produkId = $request->produk_id;
        $beforeDate = $request->sebelum_tanggal;
        $afterDate = $request->sesudah_tanggal;

        $stokOpname = StokOpname::getStockOpnameByQuery($cabangId, $produkId, $beforeDate, $afterDate)->get();

        return response()->json($stokOpname, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['cabang_id'] = $this->getCabang($request)->cabang_id;
        $data['tanggal_stok_opname'] = Carbon::now();

        StokOpname::create($data);

        return response()->json($data, 201);
    }

    public function update(Request $request, $stokOpname)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['tanggal_stok_opname'] = Carbon::now();

        $stokOpname = StokOpname::find($stokOpname);
        $stokOpname->update($data);

        return response()->json($stokOpname, 200);
    }

    public function show(Request $request, $stokOpname)
    {
        $stokOpname = StokOpname::getDetailStockOpname($stokOpname)->first();

        return response()->json($stokOpname, 200);
    }

    private function getCabang($request)
    {
        return $request->user()->cabang()->first();
    }
}
