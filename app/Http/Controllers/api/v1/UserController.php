<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $request['password'] = Hash::make($request['password']);

        $user = User::create($request->toArray());

        return response()->json($user, 201);
    }

    public function update(Request $request)
    {
        $user = $request->user()->id;
        $request['password'] = Hash::make($request['password']);

        $user->update($request->toArray());

        return response()->json($user, 200);
    }
}
