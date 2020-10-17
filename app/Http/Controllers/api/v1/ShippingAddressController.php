<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Konsumen;
use App\AlamatPengiriman;
use Illuminate\Http\Request;
use stdClass;

class ShippingAddressController extends Controller
{
    public function index(Request $request)
    {   
        $konsumen = $this->getKonsumen($request);
        $alamatPengiriman = $konsumen->alamatPengiriman()->get();
        
        return response()->json($alamatPengiriman, 200);
    }

    public function store(Request $request)
    {
        $konsumen = $this->getKonsumen($request);
        $alamatPengiriman = new AlamatPengiriman();

        $alamatPengiriman->alamat = $request->alamat;
        $alamatPengiriman->konsumen_id = $konsumen->konsumen_id;
        
        $alamatPengiriman->save();

        return response()->json($alamatPengiriman, 201);
    }

    public function update(Request $request, $id)
    {
        $alamatPengiriman = AlamatPengiriman::find($id);

        $alamatPengiriman->alamat = $request->alamat;
        
        $alamatPengiriman->save();

        return response()->json($alamatPengiriman, 200);
    }
 
    public function show(Request $request, $id)
    {
        $alamatPengiriman = AlamatPengiriman::find($id);

        return response()->json($alamatPengiriman, 200);
    }

    public function destroy(Request $request, $id)
    {
        $alamatPengiriman = AlamatPengiriman::find($id);
        $alamatPengiriman->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getKonsumen($request)
    {
        return $request->user()->konsumen()->first();
    }
}
