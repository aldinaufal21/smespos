<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class KaryawanController extends Controller
{
    use ImageUpload;
    
    public function index(Request $request)
    {   
        $umkm = $this->getUmkm($request);
        $karyawan = $umkm->karyawan()->get();
        
        return response()->json($karyawan, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'foto' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $umkm = $this->getUmkm($request);
        $requestData['umkm_id'] = $umkm->umkm_id;
        
        $fotoKaryawan = $request->foto;
        $urlFoto = $request->foto != null ?
                    $this->storeKaryawanImage($fotoKaryawan) : null;
        $requestData['foto'] = $urlFoto;
        $requestData['tanggal_bergabung'] = Carbon::now();

        $karyawan = Karyawan::create($requestData);

        return response()->json($karyawan, 201);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        
        $validator = Validator::make($requestData, [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'foto' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $umkm = $this->getUmkm($request);
        $karyawan = Karyawan::find($id)->first();
        
        if (!$karyawan->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }
        
        $fotoKaryawan = $request->foto;
        $urlFoto = $request->foto != null ?
                    $this->storeKaryawanImage($fotoKaryawan) : null;
        $requestData['foto'] = $urlFoto;

        $karyawan->update($requestData);

        return response()->json($karyawan, 200);
    }
 
    public function show(Request $request, $id)
    {

        $umkm = $this->getUmkm($request);
        $karyawan = Karyawan::find($id);
        
        if (!$karyawan->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return response()->json($karyawan, 200);
    }

    public function destroy(Request $request, $id)
    {
        $umkm = $this->getUmkm($request);
        $karyawan = Karyawan::find($id);
        
        if (!$karyawan->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }
        
        $karyawan->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }
}
