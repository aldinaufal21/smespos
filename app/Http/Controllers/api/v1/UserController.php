<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request->toArray());

        return response()->json($user, 201);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        
        $user = $request->user()->id;
        $request['password'] = Hash::make($request['password']);

        $user->update($request->toArray());

        return response()->json($user, 200);
    }
}
