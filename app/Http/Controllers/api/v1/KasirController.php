<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Kasir;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use stdClass;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $cabang = $this->getCabang($request);
        $kasir = $cabang->kasir()->get();

        return response()->json($kasir, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $cabang = $this->getCabang($request);

        $validator = Validator::make($requestData, [
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|confirmed',
            'nama_kasir' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        
        DB::beginTransaction();
        try {
            $requestData['password'] = Hash::make($requestData['password']);
            $requestData['role'] = 'kasir';
            $user = User::create($requestData);

            $requestData['cabang_id'] = $cabang->cabang_id;
            $requestData['user_id'] = $user->id;
    
            $kasir = Kasir::create($requestData);
    
            $response = array_merge($user->toArray(), $kasir->toArray());
            
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
        $kasir = Kasir::find($id);

        DB::beginTransaction();
        try {
            $user = $kasir->user()->first();

            if ($request->username == $user->username) {
                unset($requestData['username']);
            }

            if ($request->password == null) {
                unset($requestData['password']);
            }

            $validator = Validator::make($requestData, [
                'username' => 'string|max:255|unique:users',
                'password' => 'confirmed',
                'nama_kasir' => 'required|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()->all()
                ], 400);
            }

            $user->update($requestData);
            
            $kasir = $kasir->update($requestData);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'message' => env('APP_ENV') != 'production' ? $e : 'Internal Server Error',
            ], 500);
        }

        return response()->json($kasir, 200);
    }

    public function show(Request $request, $id)
    {

        $cabang = $this->getCabang($request);
        $kasir = Kasir::find($id);

        if (!$kasir->wasBelongsTo($cabang)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return response()->json($kasir, 200);
    }

    public function destroy(Request $request, $id)
    {
        $cabang = $this->getCabang($request);
        $kasir = Kasir::find($id);

        if (!$kasir->wasBelongsTo($cabang)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $kasir->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getCabang($request)
    {
        return $request->user()->cabang()->first();
    }
}
