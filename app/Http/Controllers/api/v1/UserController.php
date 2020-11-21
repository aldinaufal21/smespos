<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = User::all();
        
        return response()->json($user, 201);
    }

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

    public function update(Request $request, $id)
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
        
        $user = User::find($id);
        $request['password'] = Hash::make($request['password']);

        $user->update($request->toArray());

        return response()->json($user, 200);
    }

    public function reset(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|max:255|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        
        $user = User::find($id);
        $request['password'] = Hash::make($request['password']);

        $user->update($request->toArray());

        return response()->json($user, 200);
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        $request['password'] = Hash::make($request['password']);

        return response()->json($user, 200);
    }
    
}
