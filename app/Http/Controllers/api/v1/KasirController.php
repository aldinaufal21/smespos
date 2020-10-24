<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index(Request $request)
    {   
        $umkm = $this->getUmkm($request);
        $cabang = $umkm->cabang()->get();
        
        return response()->json($cabang, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255|confirmed',
            'nama_cabang' => 'required|string|max:255',
            'alamat_cabang' => 'required|string|max:255',
            'jumlah_karyawan' => 'required|string|max:255',
            'gambar_karyawan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        
        DB::beginTransaction();
        try {
            $user = User::create($requestData);

            $umkm = $this->getUmkm($request);
            $requestData['umkm_id'] = $umkm->umkm_id;
            $requestData['user_id'] = $user->id;
            
            $gambarKaryawan = $request->gambar_karyawan;
            $urlFoto = $request->gambar_karyawan != null ?
                        $this->storeKaryawanCabangImage($gambarKaryawan) : null;
            $requestData['gambar_karyawan'] = $urlFoto;
    
            $cabang = Cabang::create($requestData);
    
            $response = array_merge($user->toArray(), $cabang->toArray());
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($response, 201);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'username' => 'string|max:255|unique:users',
            'password' => 'string|max:255|confirmed',
            'nama_cabang' => 'string|max:255',
            'alamat_cabang' => 'string|max:255',
            'jumlah_karyawan' => 'string|max:255',
            'gambar_karyawan' => '',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        
        DB::beginTransaction();
        try {
            $cabang = Cabang::find($id);
            $user = $cabang->user->first();

            $gambarKaryawan = $request->gambar_karyawan;
            $urlFoto = $request->gambar_karyawan != null ?
                        $this->storeKaryawanCabangImage($gambarKaryawan) : 
                        $cabang->gambar_karyawan;
            $requestData['gambar_karyawan'] = $urlFoto;
    
            $cabang = $cabang->update($requestData);
    
            $response = new stdClass();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($response, 200);
    }
 
    public function show(Request $request, $id)
    {

        $umkm = $this->getUmkm($request);
        $cabang = Cabang::find($id);
        
        if (!$cabang->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return response()->json($cabang, 200);
    }

    public function destroy(Request $request, $id)
    {
        $umkm = $this->getUmkm($request);
        $cabang = Cabang::find($id);
        
        if (!$cabang->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }
        
        $cabang->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }
}
