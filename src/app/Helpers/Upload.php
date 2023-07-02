<?php


use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($path, $file, $fileOld = null)
    {
        if(!empty($fileOld)) {
            $pathFile = substr($fileOld, strlen(env('AWS_URL').'/'));
            Storage::disk(env('FILESYSTEM_DRIVER'))->delete($pathFile);
        }
        $newFileName = $path.'/'.time() . rand(1, 99) . uniqid() . '.' . $file->extension();
        if(!Storage::disk(env('FILESYSTEM_DRIVER'))->put($newFileName, fopen($file, 'r+'), 'public')) {
            return '';
        }
        return Storage::disk('s3')->url($newFileName);
    }
}

if (!function_exists('showFile')) {
    function showFile($fileName)
    {
        if (empty($fileName)) {
            $newFileName = config('const.image.imageNull');
        } else {
            $path = substr($fileName, strlen(env('AWS_URL').'/'));
            $newFileName = Storage::disk(env('FILESYSTEM_DRIVER'))->exists($path) ? $fileName :config('const.image.imageNull');
        }
        return $newFileName;
    }
}

if (!function_exists('uploadFileMultiple')) {
    function uploadFileMultiple($path, $files)
    {
        $file_images = array();
        foreach ($files as $key => $file) {
            $fileName = $path.'/'.time() . rand(1, 99) . uniqid() . '.' . $file->extension();
            if(!Storage::disk(env('FILESYSTEM_DRIVER'))->put($fileName, fopen($file, 'r+'), 'public')) {
                $file_images[$key] = '';
            }else {
                $file_images[$key] = Storage::disk('s3')->url($fileName);
            }
        }
        return $file_images;
    }
}

if (!function_exists('deleteSingleFile')) {
    function deleteSingleFile($fileName)
    {
        if (empty($fileName)) {
            return false;
        }
        $path = substr($fileName, strlen(env('AWS_URL').'/'));
        return Storage::disk(env('FILESYSTEM_DRIVER'))->delete($path);
    }
}

if (!function_exists('deleteMultipleFile')) {
    function deleteMultipleFile($fileNames)
    {
        if (empty($fileName)) {
            return false;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->delete($fileName);
    }
}

