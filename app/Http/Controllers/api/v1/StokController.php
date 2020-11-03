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
    public function index(Request $request, $product)
    {
        //
    }

    public function store(Request $request, $product)
    {
        $cabang = $this->getCabang($request);
        
        $validator = Validator::make($request->all(), [
            'stok' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['produk_id'] = $product;
        $data['cabang_id'] = $cabang->cabang_id;
        $data['tanggal_input'] = Carbon::now();

        Stok::create($data);

        return response()->json($data, 201);
    }

    private function getCabang($request)
    {
        return $request->user()->cabang()->first();
    }
}
