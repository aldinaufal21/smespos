<?php

namespace App\Http\Controllers\api\v1;

use App\Cabang;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\Kasir;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use stdClass;

class CabangController extends Controller
{
    use ImageUpload;

    public function index(Request $request)
    {   
        $umkm = $this->getUmkm($request);
        $cabang = Cabang::getCabangByQuery($umkm->umkm_id);
        
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
            'kode_cabang' => 'required|string|max:255|unique:cabangs',
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
            $requestData['password'] = Hash::make($requestData['password']);
            $requestData['role'] = 'cabang';
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
        
        DB::beginTransaction();
        try {
            $cabang = Cabang::find($id);
            $user = $cabang->user()->first();

            if ($request->username == $user->username) {
                unset($requestData['username']);
            }

            if ($request->password == null) {
                unset($requestData['password']);
            }

            $validator = Validator::make($requestData, [
                'username' => 'string|max:255|unique:users',
                'password' => 'confirmed',
                'nama_cabang' => 'string|max:255',
                'alamat_cabang' => 'string|max:255',
                'kode_cabang' => 'string|max:255',
                'jumlah_karyawan' => 'string|max:255',
            ]);
    
            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $user->update($requestData);

            $gambarKaryawan = $request->gambar_karyawan;
            $urlFoto = $request->gambar_karyawan != null ?
                        $this->storeKaryawanCabangImage($gambarKaryawan) : 
                        $cabang->gambar_karyawan;
            $requestData['gambar_karyawan'] = $urlFoto;
    
            $cabang = $cabang->update($requestData);
    
            $response = Cabang::find($id);
            
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
        if (in_array($this->getRole($request), ['umkm', 'cabang', 'pengelola'])) {
            $cabang = Cabang::getCabangById($id);
        } else {
            $cabang = Cabang::find($id);
        }

        return response()->json($cabang, 200);
    }

    public function destroy(Request $request, $id)
    {
        $umkm = $this->getUmkm($request);
        $cabang = Cabang::find($id);
        $user = $cabang->user()->first();
        
        if (!$cabang->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }
        
        try {
            DB::beginTransaction();

            $cabang->delete();
            $user->delete();
            
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json(new stdClass(), 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }

    private function getRole($request)
    {
        return $request->user()->role;
    }
}
