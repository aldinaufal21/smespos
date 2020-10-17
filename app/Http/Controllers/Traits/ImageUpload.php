<?php

namespace App\Http\Controllers\Traits;

trait ImageUpload
{
    public function storeUserProfileImage($file)
    {
        if(env('APP_ENV') == 'staging'){
            return $this->coudinaryUpload($file, 'payment_confirmation');
        } else if (env('APP_ENV') == 'production') {
            return $this->localImageUpload($file, 'user_avatar');
        }
        return $this->localImageUpload($file, 'user_avatar');
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
