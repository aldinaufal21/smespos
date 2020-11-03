<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Kasir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use stdClass;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $cabang = $this->getCabang($request);
        $kasir = $cabang->kasir()->get();

        return response()->json($kasir, 200);
    }

    public function store(Request $request)
    {
        $requestData = $request->all();
        $cabang = $this->getCabang($request);

        $validator = Validator::make($requestData, [
            'nama_kasir' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $requestData['cabang_id'] = $cabang->cabang_id;

        $kasir = Kasir::create($requestData);

        return response()->json($kasir, 201);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $kasir = Kasir::find($id);

        $validator = Validator::make($requestData, [
            'nama_kasir' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $kasir = $kasir->update($requestData);

        return response()->json($kasir, 200);
    }

    public function show(Request $request, $id)
    {

        $cabang = $this->getCabang($request);
        $kasir = Kasir::find($id);

        if (!$kasir->wasBelongsTo($cabang)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        return response()->json($kasir, 200);
    }

    public function destroy(Request $request, $id)
    {
        $cabang = $this->getCabang($request);
        $kasir = Kasir::find($id);

        if (!$kasir->wasBelongsTo($cabang)) {
            return response()->json([
                'message' => 'Forbidden'
            ], 403);
        }

        $kasir->delete();

        return response()->json(new stdClass(), 200);
    }

    private function getCabang($request)
    {
        return $request->user()->cabang()->first();
    }
}
