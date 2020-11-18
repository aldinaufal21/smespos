<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required',
            'quantity' => 'required',
        ]);

        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $idProduk = $request->produk_id;
        $produk = Produk::find($idProduk);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        if ($this->getItemValue($idKonsumen, $idProduk)) {
            $existingItem = json_decode($this->getItemValue($idKonsumen, $idProduk));
            $existingItem->quantity += $request->quantity;

            $produk = json_encode($existingItem);

            $this->setItemValue($idKonsumen, $idProduk, $produk);

            return response()->json($existingItem, 200);
        }
        
        $produk = $produk->toArray();
        $produk['quantity'] = $request->quantity;
        
        $produk = json_encode($produk);

        try {
            Redis::set('cart:user:' . $idKonsumen . ':cart:' . $idProduk, $produk);
        } catch (\Exception $e) {
            throw $e;
        }

        return response()->json($produk, 201);
    }

    public function update(Request $request, $idProduk)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required',
        ]);

        $idKonsumen = $this->getKonsumen($request)->konsumen_id;
        $produk = Produk::find($idProduk);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $existingItem = json_decode($this->getItemValue($idKonsumen, $idProduk));
        $existingItem->quantity = $request->quantity;

        $produk = json_encode($existingItem);

        $this->setItemValue($idKonsumen, $idProduk, $produk);

        return response()->json($existingItem, 200);
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

    private function getItemValue($idKonsumen, $idProduk)
    {
        return Redis::get('cart:user:' . $idKonsumen . ':cart:'. $idProduk);
    }

    private function setItemValue($idKonsumen, $idProduk, $produk)
    {
        Redis::set('cart:user:' . $idKonsumen . ':cart:' . $idProduk, $produk);
    }
}
