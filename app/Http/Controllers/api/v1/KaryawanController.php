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
        $owner = $this->getTheOwner($request);
        $karyawan = $owner->karyawan()->get();
        
        return response()->json($karyawan, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'cabang_id' => 'required',
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $umkm = $this->getUmkm($request);
        $karyawan = Karyawan::find($id);
        
        if (!$karyawan->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }
        
        $fotoKaryawan = $request->foto;
        $requestData['foto'] = $fotoKaryawan != null ?
                    $this->storeKaryawanImage($fotoKaryawan) : null;

        if ($fotoKaryawan == null) {
            unset($requestData['foto']);
        }

        $karyawan->update($requestData);

        return response()->json($karyawan, 200);
    }
 
    public function show(Request $request, $id)
    {
        $role = $request->user()->role;
        $owner = $this->getTheOwner($request);
        $karyawan = Karyawan::find($id);
        
        if (!$karyawan->wasBelongsTo($owner, $role)) {
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

    public function getAll(Request $request)
    {
        $cabangId = $request->cabang_id;
        $umkmId = $request->umkm_id;

        $karyawan = Karyawan::getKaryawanByQuery($cabangId, $umkmId)->get();
        
        return response()->json($karyawan, 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }

    private function getTheOwner($request)
    {
        switch ($request->user()->role) {
            case 'umkm':
                return $this->getUmkm($request);
            case 'cabang':
                return $request->user()
                    ->cabang()->first();
            default:
                break;
        }
    }
}
