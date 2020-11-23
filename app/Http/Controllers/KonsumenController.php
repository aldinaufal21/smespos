<?php

namespace App\Http\Controllers;

class KonsumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('konsumen_app.home');
    }

    public function shop(){
        return view('konsumen_app.shop.shop');
    }

    public function profile(){
        return view('konsumen_app.user.profile');
    }

    public function wishlist(){
        return view('konsumen_app.user.wishlist');
    }

    public function cart(){
        return view('konsumen_app.cart');
    }

    public function login(){
        return view('konsumen_app.auth.login');
    }

    public function register(){
        return view('konsumen_app.auth.register');
    }

    public function checkout(){
        return view('konsumen_app.checkout');
    }

    public function pembayaran(){
        return view('konsumen_app.pembayaran');
    }

}
