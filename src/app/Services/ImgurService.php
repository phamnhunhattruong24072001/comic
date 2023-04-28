<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ImgurService
{
    const END_POINT = 'https://api.imgur.com/3/image';

    public static function uploadImage($file)
    {
        $response = Http::withHeaders([
            'Authorization' => "Client-ID ".env('IMGUR_CLIENT_ID'),
        ])->post(self::END_POINT, [
            'image' => base64_encode(file_get_contents($file)),
        ]);

        if ($response->failed()) {
            throw new \Exception("Failed to upload image to Imgur");
        }
        return $response->json('data.link');
    }

    public static function deleteImage($urlImage)
    {
        if(!empty($urlImage)) {
            $filename = basename($urlImage); // pwnEXZ9.jpg
            $extension = pathinfo($filename, PATHINFO_EXTENSION); // jpg
            $imageId = str_replace('.' . $extension, '', $filename); // pwnEXZ9

            $response = Http::withHeaders([
                'Authorization' => "Client-ID ".env('IMGUR_CLIENT_ID'),
            ])->delete(self::END_POINT.'/'.$imageId);

            if ($response->successful()) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }
}

