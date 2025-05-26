<?php

namespace App\Helpers;

use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageHelper
{
    public static function upload(UploadedFile $image, $folder = 'posts')
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Store original image
        $path = $image->storeAs('images/' . $folder . '/' . $filename);

        // Store the thumbnail
        $thumbnailPath = $image->storeAs('images/' . $folder . '/thumbnails', $filename, 'public');
        $thumbnail = Image::read($image)->scale(300, 200)->encode();
        Storage::put($thumbnailPath, $thumbnail);

        return [
            'image' => $path,
            'thumbnail' => $thumbnailPath
        ];
    }
}
