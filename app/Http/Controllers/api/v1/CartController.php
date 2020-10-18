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

        try {
            if (Redis::get('cart:user:' . $idKonsumen . ':item_count')) {
                // increment item count
                Redis::incr('cart:user:' . $idKonsumen . ':item_count');

                // get maximum item count
                $maxItemCount = Redis::get('cart:user:' . $idKonsumen . ':item_count');

                // set new item on new cart number
                Redis::set('cart:user:' . $idKonsumen . ':cart:' . $maxItemCount, $idProduk);
            } else {
                // initiate new cart if user doesn't have one
                Redis::set('cart:user:' . $idKonsumen . ':item_count', 1);
                Redis::set('cart:user:' . $idKonsumen . ':cart:1', $idProduk);
            }
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json([
            'produk_id' => $idProduk,
        ], 201);
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
            
            $item = Redis::get($key);
            $produk = Produk::find($item);
            
            array_push($shoppingCartItems, $produk);
        }
        
        return $shoppingCartItems;
    }
}
