<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\ProdukFavorit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

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

        $existingProdukFavorit = ProdukFavorit::where('produk_id', $idProduk)->first();
        if ($existingProdukFavorit) {
            return response()->json([
                'message' => 'Produk sudah termasuk ke dalam produk favorit anda'
            ], 400);
        }

        $data['produk_id'] = $idProduk;
        $data['konsumen_id'] = $konsumen->konsumen_id;
        $dataProdukFavorit = ProdukFavorit::create($data);

        return response()->json($dataProdukFavorit, 201);
    }

    private function getKonsumen($request)
    {
        return $request->user()->konsumen()->first();
    }

    public function destroy(Request $request, $id)
    {
        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $produk = ProdukFavorit::where('produk_id',$id)->where('konsumen_id', $idKonsumen)->first();
        $produk->delete();

        return response()->json(new stdClass(), 200);
    }
}
