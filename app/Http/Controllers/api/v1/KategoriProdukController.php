<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\KategoriProduk;
use Illuminate\Http\Request;
use stdClass;

/**
 * this API is for UMKM role
 */
class KategoriProdukController extends Controller
{
    public function index(Request $request)
    {   
        $umkm = $this->getUmkm($request);
        $kategoriProduk = $umkm->kategoriProduk()->get();
        
        return response()->json($kategoriProduk, 200);
    }

    public function store(Request $request)
    {
        $umkm = $this->getUmkm($request);
        $kategoriProduk = new KategoriProduk();

        $kategoriProduk->nama_kategori = $request->nama_kategori;
        $kategoriProduk->umkm_id = $umkm->umkm_id;
        
        $kategoriProduk->save();

        return response()->json($kategoriProduk, 201);
    }

    public function update(Request $request, $id)
    {
        $kategoriProduk = KategoriProduk::find($id);

        $kategoriProduk->nama_kategori = $request->nama_kategori;
        
        $kategoriProduk->save();

        return response()->json($kategoriProduk, 200);
    }
 
    public function show(Request $request, $id)
    {
        $kategoriProduk = KategoriProduk::find($id);

        return response()->json($kategoriProduk, 200);
    }

    public function destroy(Request $request, $id)
    {
        $kategoriProduk = KategoriProduk::find($id);
        $kategoriProduk->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }
}
