<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUpload;
use App\Konsumen;
use App\User;
use Illuminate\Http\Request;

class KonsumenController extends Controller
{
    use ImageUpload;

    public function details(Request $request, $id = null)
    {
        /**
         * @param $request -> isinya kolom fillable dari kolom konsumen
         * ex. nama_konsumen, alamat_konsumen, nomor_hp, gambar
         * 
         * @return -> data konsumen
         */
        $id = $request->user()->id;
        $konsumen = User::find($id)->konsumen()->first();
        
        return response()->json($konsumen, 200);
    }

    public function update(Request $request)
    {
        /**
         * @param $request -> isinya kolom fillable dari kolom konsumen
         * ex. nama_konsumen, alamat_konsumen, nomor_hp, gambar
         * 
         * @return response -> data konsumen
         */
        $id = $request->user()->id;
        $konsumen = User::find($id)->konsumen()->first();
        $requestData = $request->all();

        $userAvatar = $request->gambar;
        $avatarUrl = $request->gambar != null ?
                $this->storeUserProfileImage($userAvatar) : null;
        $requestData['gambar'] = $avatarUrl;

        $konsumen->update($requestData);

        return response()->json($konsumen, 200);
    }
}
