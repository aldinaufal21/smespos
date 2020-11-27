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

class UmkmController extends Controller
{
    use ImageUpload;

    public function index(Request $request)
    {
        $umkmId = $request->umkm_id;
        $response = [];

        if ($umkmId) {
            $umkm = Umkm::where('umkm_id', $umkmId)->first();

            $cabang = $umkm->cabang()->get();

            return response()->json([
                'umkm' => $umkm,
                'cabang' => $cabang,
            ], 200);
        }

        $umkm = Umkm::approved()->get();

        foreach ($umkm as $u) {
            $cabang = $u->cabang()->get();
            array_push($response, [
                'umkm' => $u,
                'cabang' => $cabang,
            ]);
        }

        return response()->json($response, 200);
    }

    public function profile(Request $request, $umkm)
    {
        /**
         * @return -> data umkm
         */
        $umkm = Umkm::find($umkm);

        return response()->json($umkm, 200);
    }

    public function register(Request $request)
    {
        $requestData = $request->all();

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
            $requestData['tanggal_pendaftaran'] = Carbon::now();
            $pendaftaranUmkm = PendaftaranUmkm::create($requestData);

            $response = array_merge($user->toArray(), $umkm->toArray(), $pendaftaranUmkm->toArray());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($response, 201);
    }

    public function update(Request $request)
    {
        /**
         * @return response -> data konsumen
         */
        $validator = Validator::make($request->all(), [
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

        $id = $request->user()->id;
        $umkm = User::find($id)->umkm()->first();
        $requestData = $request->all();

        $userAvatar = $request->gambar;
        $avatarUrl = $request->gambar != null ?
            $this->storeUmkmImage($userAvatar) : null;
        $requestData['gambar'] = $avatarUrl;

        $umkm->update($requestData);

        return response()->json($umkm, 200);
    }

    public function approveRegister(Request $request)
    {
        $pengelola = $request->user()->pengelola()->first();

        $UmkmId = $request->umkm_id;
        $umkm = Umkm::find($UmkmId);

        DB::beginTransaction();
        try {
            $dataUmkm['tanggal_bergabung'] = Carbon::now();
            $umkm->update($dataUmkm);

            $pendaftaranUmkm = $umkm->pendaftaranUmkm()->first();

            $dataPendaftaranUmkm['pengelola_id'] = $pengelola->pengelola_id;
            $dataPendaftaranUmkm['status_pendaftaran'] = 'approved';

            $pendaftaranUmkm->update($dataPendaftaranUmkm);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($pendaftaranUmkm, 200);
    }
}
