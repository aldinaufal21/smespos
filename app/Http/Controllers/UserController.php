<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('user.index');
    }
    
    public function create(Request $request)
    {
        return view('user.create');
    }
    
    public function show(Request $request)
    {
        return view('user.show');
    }
    
    public function edit(Request $request)
    {
        return view('user.edit');
    }

    public function changePassword()
    {
        return view('user.change_password');
    }
    
}
