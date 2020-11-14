<?php

namespace App\Http\Controllers\api\v1;

use App\Bank;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class BankController extends Controller
{

    public function index(Request $request)
    {   
        $umkmId = $request->id_umkm;
        $bank = Bank::getBankByUmkm($umkmId);
        
        return response()->json($bank, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();

        $validator = Validator::make($requestData, [
            'nama_bank' => 'required|string|max:255',
            'rekening' => 'required|string|max:255',
            'atas_nama' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $requestData['umkm_id'] = $this->getUmkm($request)->umkm_id;
        $bank = Bank::create($requestData);

        return response()->json($bank, 201);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $umkm = $this->getUmkm($request);

        $validator = Validator::make($requestData, [
            'nama_bank' => 'string|max:255',
            'rekening' => 'string|max:255',
            'atas_nama' => 'string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $bank = Bank::find($id);

        if (!$bank->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $requestData['umkm_id'] = $umkm->umkm_id;
        $bank->update($requestData);

        return response()->json($bank, 200);
    }
 
    public function show(Request $request, $id)
    {
        $bank = Bank::find($id);

        return response()->json($bank, 200);
    }

    public function destroy(Request $request, $id)
    {
        $umkm = $this->getUmkm($request);
        $bank = Bank::find($id);

        if (!$bank->wasBelongsTo($umkm)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }
        
        $bank->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getUmkm($request)
    {
        return $request->user()->umkm()->first();
    }
}
