<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\Konsumen;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * this API is for consumer role
 */
class KonsumenController extends Controller
{
    use ImageUpload;

    public function details(Request $request, $id = null)
    {
        /**
         * @param $request -> isinya kolom fillable dari kolom konsumen
         * ex. nama_konsumen, alamat_konsumen, nomor_hp, gambar
         *
         * @return -> data konsumen
         */
        $id = $request->user()->id;
        $konsumen = User::find($id)->konsumen()->first();

        return response()->json($konsumen, 200);
    }

    public function register(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:255|min:6|confirmed',
            'nama_konsumen' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $requestData['password'] = Hash::make($requestData['password']);
        $requestData['role'] = 'konsumen';

        DB::beginTransaction();
        try {
            $user = User::create($requestData);

            $userAvatar = $request->gambar;
            $avatarUrl = $request->gambar != null ?
                $this->storeUserProfileImage($userAvatar) : '';
            $requestData['gambar'] = $avatarUrl;
            $requestData['user_id'] = $user->id;
            $requestData['tanggal_gabung'] = Carbon::now();
            $requestData['login_terakhir'] = Carbon::createFromDate(null, null, null, null);

            $konsumen = Konsumen::create($requestData);

            $response = array_merge($user->toArray(), $konsumen->toArray());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($response, 201);
    }

    public function update(Request $request)
    {
        /**
         * @param $request -> isinya kolom fillable dari kolom konsumen
         * ex. nama_konsumen, alamat_konsumen, nomor_hp, gambar
         *
         * @return response -> data konsumen
         */
        $validator = Validator::make($request->all(), [
            'nama_konsumen' => 'required|string|max:255',
            'alamat_konsumen' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:14|min:10',
            'gambar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $id = $request->user()->id;
        $konsumen = User::find($id)->konsumen()->first();
        $requestData = $request->all();

        $userAvatar = $request->gambar;
        $avatarUrl = $request->gambar != null ?
                $this->storeUserProfileImage($userAvatar) : null;
        $requestData['gambar'] = $avatarUrl;

        $konsumen->update($requestData);

        return response()->json($konsumen, 200);
    }
}
