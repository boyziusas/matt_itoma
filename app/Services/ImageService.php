<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService{
    /**TODO::replace image handling logic from company requests, add resizing, thumbnails*/

    /**
     * @param $image
     */
    public function saveToStorage($image):void
    {
        Storage::disk('public')->put('' , $image, 'public');
    }
}
