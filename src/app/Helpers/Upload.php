<?php


use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($path, $file, $key = 0)
    {
        if (!$file) {
            return '';
        }
        $newFileName = time() . rand(1, 99) . uniqid() . '.' . $file->extension();
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
                $newFileName = 'storage/' . $fileName;
            } else {
                $newFileName = config('const.image.imageNull');
            }
        }
        return $newFileName;
    }
}

if (!function_exists('uploadFileMultiple')) {
    function uploadFileMultiple($path, $files)
    {
        $file_images = array();
        foreach ($files as $key => $file) {
            $fileName = time() . rand(1, 99) . uniqid() . '.' . $file->extension();
            Storage::disk('local')->putFileAs(
                'files/' . $fileName,
                $file,
                $fileName
            );
            $pathName = $file->storeAs($path, $fileName, 'local');
            $file_images[$key] = substr($pathName, strlen('public/'));
        }
        return $file_images;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($fileName)
    {
        Storage::disk('public')->delete($fileName);
    }
}
