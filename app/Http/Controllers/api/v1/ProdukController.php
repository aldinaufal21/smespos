<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use stdClass;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $umkm = $this->getUmkm($request);
        $kategoriProduk = $umkm->kategoriProduk()->get();

        return response()->json($kategoriProduk, 200);
    }

    public function store(Request $request, $category)
    {
        $data = $request->all();
        
        $data['kategori_produk_id'] = $category;
        $data['tanggal_input'] = Carbon::now();

        $produk = Produk::create($data);

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $data = $request->all();

        $produk->update($data);

        return response()->json($produk, 200);
    }

    public function show(Request $request, $id)
    {
        $produk = Produk::find($id);

        return response()->json($produk, 200);
    }

    public function destroy(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }
}
