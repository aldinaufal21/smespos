<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use stdClass;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $konsumen = $this->getKonsumen($request);

        $dataCart = $this->getCartValues($konsumen->konsumen_id);

        return response()->json($dataCart, 200);
    }

    public function store(Request $request)
    {
        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $idProduk = $request->produk_id;
        $produk = json_encode(Produk::find($idProduk));

        try {
            Redis::set('cart:user:' . $idKonsumen . ':cart:' . $idProduk, $produk);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'produk_id' => $idProduk,
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        
        try {
            Redis::del('cart:user:' . $idKonsumen . ':cart:' . $id);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json(new stdClass(), 200);
    }

    private function getKonsumen($request)
    {
        return $request->user()->konsumen()->first();
    }

    private function getCartValues($idKonsumen)
    {
        $keyPrefix = 'cart:user:' . $idKonsumen . ':cart:';
        $shoppingCartItems = [];

        foreach (Redis::keys("{$keyPrefix}*") as $key) {
            $key = str_replace(config('database.redis.options.prefix'), '', $key);
            
            $item = json_decode(Redis::get($key));
            
            array_push($shoppingCartItems, $item);
        }
        
        return $shoppingCartItems;
    }
}
