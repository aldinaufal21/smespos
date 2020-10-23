<?php

namespace App\Http\Controllers\Traits;

trait ImageUpload
{
    public function storeUserProfileImage($file)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, '');
        } else if (env('APP_ENV') == 'production') {
            return $this->localImageUpload($file, 'user_avatar');
        }
        return $this->localImageUpload($file, 'user_avatar');
    }

    public function storeUmkmImage($file)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, '');
        } else if (env('APP_ENV') == 'production') {
            return $this->localImageUpload($file, 'umkm_image');
        }
        return $this->localImageUpload($file, 'umkm_image');
    }

    public function storeKaryawanImage($file)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, '');
        } else if (env('APP_ENV') == 'production') {
            return $this->localImageUpload($file, 'karyawan_image');
        }
        return $this->localImageUpload($file, 'karyawan_image');
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
