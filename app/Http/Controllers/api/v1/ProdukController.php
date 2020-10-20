<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\KategoriProduk;
use App\Produk;
use App\StokOpname;
use App\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class ProdukController extends Controller
{
    /**
     * API for all users
     */
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
            $stokOpname = $p->stokOpname()->first();
            
            $p['kategori'] = $kategori;
            $p['umkm'] = $umkm;
            $p['tanggal_stok_opname'] = $stokOpname->tanggal_stok_opname;
            $p['harga'] = $stokOpname->harga;

            array_push($dataProduk, $p);
        }

        return response()->json($dataProduk, 200);
    }

    /**
     * API for UMKM
     */
    public function store(Request $request, $category)
    {
        $data = $request->all();
        
        $data['kategori_produk_id'] = $category;
        $data['tanggal_input'] = Carbon::now();
        $data['tanggal_stok_opname'] = Carbon::now();

        DB::beginTransaction();
        try {
            $data['stok'] = $data['jumlah'];
            $produk = Produk::create($data);

            $data['produk_id'] = $produk->produk_id;
            StokOpname::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
                    
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($data, 201);
    }


    /**
     * API for UMKM
     */
    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        $data = $request->all();

        $produk->update($data);

        return response()->json($produk, 200);
    }


    /**
     * API for all user
     */
    public function show(Request $request, $id)
    {
        $produk = Produk::find($id);
    
        $kategori = $produk->kategori()->first();
        $umkm = $kategori->umkm()->first();
        
        $produk['kategori'] = $kategori;
        $produk['umkm'] = $umkm;

        return response()->json($produk, 200);
    }

    /**
     * API for UMKM
     */
    public function destroy(Request $request, $id)
    {
        $produk = Produk::find($id);
        $produk->delete();

        return response()->json(new stdClass(), 200);
    }
}
