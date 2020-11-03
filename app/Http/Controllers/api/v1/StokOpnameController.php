<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\StokOpname;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StokOpnameController extends Controller
{
    public function store(Request $request, $produk)
    {
        $validator = Validator::make($request->all(), [
            'jumlah' => 'required|numeric|gte:0',
            'harga' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['tanggal_stok_opname'] = Carbon::now();
        $data['produk_id'] = $produk;

        StokOpname::create($data);

        return response()->json($data, 201);
    }
}
