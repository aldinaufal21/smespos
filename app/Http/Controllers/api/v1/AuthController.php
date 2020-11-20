<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $user = User::where('username', $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                if ($user->role == 'umkm') {
                    if (!$this->umkmApproved($user)) {
                        return response()->json([
                            'message' => 'UMKM Belum Disetujui'
                        ], 401);
                    }
                }

                $responseEachUser = $this->responseEachUser($user);

                return response()->json($responseEachUser, 200);
            } else {
                return response()->json([
                    'message' => 'Password missmatch'
                ], 401);
            }
        } else {
            return response()->json([
                'message' => 'User does not exist'
            ], 400);
        }
    }

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'You have been successfully logged out!'
        ], 200);
    }

    public function details(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'user' => $user
        ], 200);
    }

    public function resetPassword(Request $request)
    {
        $user = $request->user();
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'existing_password' => 'required|string|min:6',
            'new_password' => 'required|string|min:6|confirmed|different:existing_password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        if (!Hash::check($requestData['existing_password'], $user->password)) {
            return response()->json([
                'message' => 'Password missmatch'
            ], 401);
        }

        $user->password = Hash::make($requestData['new_password']);
        $user->save();

        return response()->json($user, 200);
    }

    private function responseEachUser($user): array
    {
        $role = $user->role;
        $token = $user->createToken('User Login')->accessToken;

        switch ($role) {
            case 'umkm':
                $umkm = $user->umkm()->first();
                return [
                    'token' => $token,
                    'user' => $user,
                    'umkm' => $umkm,
                ];

            case 'konsumen':
                $konsumen = $user->konsumen()->first();
                return [
                    'token' => $token,
                    'user' => $user,
                    'konsumen' => $konsumen,
                ];

            case 'cabang':
                $cabang = $user->cabang()->first();
                return [
                    'token' => $token,
                    'user' => $user,
                    'cabang' => $cabang,
                ];

            case 'kasir':
                $kasir = $user->kasir()->first();
                $cabang = $kasir->cabang()->first();
                $data = [
                    'token' => $token,
                    'user' => $user,
                    'kasir' => $kasir,
                    'cabang' => $cabang
                ];
                if ($kasir->status_kasir == 'buka')
                    $data['sesi_kasir'] = DB::table('sesi_kasirs')->where('kasir_id', $kasir->kasir_id)->orderBy('sesi_kasir_id', 'DESC')->first();

                return $data;

            case 'pengelola':
                $pengelola = $user->pengelola()->first();
                return [
                    'token' => $token,
                    'user' => $user,
                    'pengelola' => $pengelola,
                ];
            default:
                break;
        }
    }

    private function umkmApproved($user): bool
    {
        $statusPendaftaran = $user->umkm()->first()
            ->pendaftaranUmkm()->first()->status_pendaftaran;

        return $statusPendaftaran == 'approved' ? true : false;
    }
}
