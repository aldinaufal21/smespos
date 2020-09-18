<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index()
    {
        return Role::all();
    }
 
    public function show($id)
    {
        return Role::find($id);
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());

        return response()->json($role, 201);
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role->update($request->all());

        return response()->json($role, 200);
    }

    public function delete(Request $request, $id)
    {
        $role = Role::find($id);
        $role->delete();

        return response()->json(null, 204);
    }
}
