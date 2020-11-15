<?php

namespace App\Http\Controllers\Traits;

trait ImageUpload
{
    public function storeUserProfileImage($file)
    {
        return $this->storeImages($file, 'user_avatar');
    }

    public function storeUmkmImage($file)
    {
        return $this->storeImages($file, 'umkm_image');
    }

    public function storeKaryawanImage($file)
    {
        return $this->storeImages($file, 'karyawan_image');
    }

    public function storeKaryawanCabangImage($file)
    {
        return $this->storeImages($file, 'karyawan_cabang_image');
    }

    public function storeProductImages($file)
    {
        return $this->storeImages($file, 'produk');
    }

    public function storeBuktiPembayaran($file)
    {
        return $this->storeImages($file, 'bukti_pembayaran_images');
    }

    private function storeImages($file, $folder)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, '');
        } else if (env('APP_ENV') == 'production') {
            return $this->localImageUpload($file, $folder);
        }
        return $this->localImageUpload($file, $folder);
    }

    private function localImageUpload($file, $folder)
    {
        /* get File Extension */
        $extension = $file->getClientOriginalExtension();

        /* Your File Destination */
        $directoryTarget = 'images/' . $folder;
    
        /* unique Name for file */
        $filename = uniqid() . '.' . $extension;
    
        /* finally move file to your destination */
        $file->move($directoryTarget,  $filename);

        /** will output
         * http://localhost:8000/ + directory target + filename
         */
        return url('/') . '/' . $directoryTarget . '/' . $filename;
    }
}
