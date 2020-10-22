<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\ProdukFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * this API is for consumer
 */
class ProdukFavoritController extends Controller
{
    public function index(Request $request)
    {
        $konsumen = $this->getKonsumen($request);
        $produkFavorit = $konsumen->produkFavorit()->get();

        $dataProdukFavorit = [];

        foreach ($produkFavorit as $p) {
            array_push($dataProdukFavorit, $p);
        }

        return response()->json($dataProdukFavorit, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        
        $konsumen = $this->getKonsumen($request);
        $idProduk = $request->produk_id;
        $dataProdukFavorit = [];
        
        DB::beginTransaction();
        try {
            foreach ($idProduk as $p) {
                $data['produk_id'] = $p;
                $data['konsumen_id'] = $konsumen->konsumen_id;
                ProdukFavorit::create($data);
                array_push($dataProdukFavorit, $data);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($dataProdukFavorit, 201);
    }

    private function getKonsumen($request)
    {
        return $request->user()->konsumen()->first();
    }
}
