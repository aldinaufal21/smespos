<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\KategoriProduk;
use App\Produk;
use App\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $namaProduk = $request->name;
        $kategoriProduk = $request->kategori;
        $idKategori = $request->id_kategori;

        $produk = Produk::getProductByQuery($namaProduk, $kategoriProduk, $idKategori);

        $dataProduk = [];
        
        foreach ($produk as $p) {
            $kategori = $p->kategori()->first();
            $umkm = $kategori->umkm()->first();
            
            $p['kategori'] = $kategori;
            $p['umkm'] = $umkm;

            array_push($dataProduk, $p);
        }

        return response()->json($dataProduk, 200);
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
    
        $kategori = $produk->kategori()->first();
        $umkm = $kategori->umkm()->first();
        
        $produk['kategori'] = $kategori;
        $produk['umkm'] = $umkm;

        return response()->json($produk, 200);
    }

    public function destroy(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response()->json(new stdClass(), 200);
    }
}
