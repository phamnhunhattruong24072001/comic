<?php


use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($path, $file)
    {
        $newFileName = time() . '.' . $file->extension();
        Storage::disk('local')->putFileAs(
            'files/' . $newFileName,
            $file,
            $newFileName
        );
        $path = $file->storeAs($path, $newFileName, 'local');
        return substr($path, strlen('public/'));
    }
}

if (!function_exists('showFile')) {
    function showFile($fileName)
    {
        if ($fileName == null) {
            $newFileName = config('const.image.imageNull');
        } else {
            $exists = Storage::disk('public')->exists($fileName);
            if ($exists) {
               $newFileName = $fileName;
            } else {
                $newFileName = config('const.image.imageNull');
            }
        }
        return $newFileName;
    }
}
