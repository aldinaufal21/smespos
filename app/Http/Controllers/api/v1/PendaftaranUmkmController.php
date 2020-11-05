<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\PendaftaranUmkm;
use App\Umkm;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PendaftaranUmkmController extends Controller
{
    use ImageUpload;
    
    public function index(Request $request)
    {
        $query = $request->q;

        if ($query == 'pending') {
            $pendaftaranUmkm = PendaftaranUmkm::pending()->get();
        } elseif ($query == 'approved') {
            $pendaftaranUmkm = PendaftaranUmkm::approved()->get();
        } else {
            $pendaftaranUmkm = PendaftaranUmkm::all();
        }

        $response = [];

        foreach ($pendaftaranUmkm as $data) {
            $umkm = $data->umkm()->first();
            $userData = $umkm->user()->first();
            array_push($response, array_merge($data->toArray(), $umkm->toArray(), $userData->toArray()));
        }

        return response()->json($response, 200);
    }
    
    public function store(Request $request)
    {
        $requestData = $request->all();
        $idPengelola = $request->user()->pengelola()->first()->pengelola_id;

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255|confirmed',
            'nama_umkm' => 'required|string|max:255',
            'alamat_umkm' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'gambar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        
        $requestData['password'] = Hash::make($requestData['password']);
        $requestData['role'] = 'umkm';
        $requestData['tanggal_bergabung'] = Carbon::now();

        DB::beginTransaction();
        try {
            $user = User::create($requestData);
    
            $userAvatar = $request->gambar;
            $avatarUrl = $request->gambar != null ?
                    $this->storeUmkmImage($userAvatar) : null;
            $requestData['gambar'] = $avatarUrl;
            $requestData['user_id'] = $user->id;

            $umkm = Umkm::create($requestData);
            
            $requestData['umkm_id'] = $umkm->umkm_id;
            $requestData['pengelola_id'] = $idPengelola;
            $requestData['status_pendaftaran'] = 'approved';
            $requestData['tanggal_pendaftaran'] = Carbon::now();
            $pendaftaranUmkm = PendaftaranUmkm::create($requestData);
            
            DB::commit();

            $response = array_merge($user->toArray(), $umkm->toArray(), $pendaftaranUmkm->toArray());
            

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }
        
        return response()->json($response, 201);
    }
}
