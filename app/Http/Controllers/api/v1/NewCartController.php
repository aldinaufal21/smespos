<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class NewCartController extends Controller
{
    public function index(Request $request)
    {
        $konsumen = $this->getKonsumen($request);

        $dataCart = Keranjang::getDetailKeranjangByQuery($konsumen->konsumen_id)->get();

        return response()->json($dataCart, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'quantity' => 'required',
        ]);

        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $idProduk = $request->produk_id;
        $existingKeranjang = Keranjang::getKeranjangByQuery($idKonsumen, $idProduk);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        if ($existingKeranjang) {
            $existingKeranjang->quantity += $request->quantity;
            $existingKeranjang->update();

            return response()->json($existingKeranjang, 200);
        }

        $requestData['konsumen_id'] = $idKonsumen;
        $keranjang = Keranjang::create($requestData);

        return response()->json($keranjang, 201);
    }

    public function update(Request $request, $idProduk)
    {
        $requestData = $request->all();
        $validator = Validator::make($requestData, [
            'quantity' => 'required',
        ]);

        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $keranjang = Keranjang::getKeranjangByQuery($idKonsumen, $idProduk);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $keranjang->update($requestData);

        return response()->json($keranjang, 200);
    }

    public function destroy(Request $request, $idProduk)
    {
        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $keranjang = Keranjang::getKeranjangByQuery($idKonsumen, $idProduk);

        $keranjang->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getKonsumen($request)
    {
        return $request->user()->konsumen()->first();
    }
}
