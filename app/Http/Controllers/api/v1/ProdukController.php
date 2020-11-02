<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\KategoriProduk;
use App\Produk;
use App\Stok;
use App\StokOpname;
use App\Umkm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use stdClass;

class ProdukController extends Controller
{
    use ImageUpload;
    
    /**
     * API for all users
     */
    public function index(Request $request)
    {
        $namaProduk = $request->name;
        $kategoriProduk = $request->kategori;
        $idKategori = $request->id_kategori;
        $idUmkm = $request->id_umkm;

        $produk = Produk::getProductByQuery($namaProduk, $kategoriProduk, $idKategori, $idUmkm);

        return response()->json($produk, 200);
    }

    /**
     * API for UMKM
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'gambar_produk' => 'required',
            'kategori_produk_id' => 'required',
            'deskripsi_produk' => 'required|string|max:255',
            'jumlah' => 'required|numeric|gte:0',
            'harga' => 'required|numeric|gte:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $data = $request->all();
        
        $data['tanggal_input'] = $data['tanggal_stok_opname'] = Carbon::now();

        DB::beginTransaction();
        try {
            $gambarProduk = $request->gambar_produk;
            $data['gambar_produk'] = $gambarProduk != null ?
                        $this->storeProductImages($gambarProduk) : null;
                        
            $produk = Produk::create($data);
            $data['produk_id'] = $produk->produk_id;
            
            StokOpname::create($data);
            
            $data['stok'] = $data['jumlah'];
            Stok::create($data);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
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
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $produk = Produk::find($id);
        $data = $request->all();

        $gambarProduk = $request->gambar_produk;
        $data['gambar_produk'] = $gambarProduk != null ?
                    $this->storeProductImages($gambarProduk) : null;

        if ($gambarProduk == null) {
            unset($data['gambar_produk']);
        }

        $produk->update($data);

        return response()->json($produk, 200);
    }


    /**
     * API for all user
     */
    public function show(Request $request, $id)
    {
        $produk = Produk::getProductDetailById($id);

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
