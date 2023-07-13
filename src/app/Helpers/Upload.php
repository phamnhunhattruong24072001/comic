<?php


use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($path, $file, $fileOld = null)
    {
        if(!empty($fileOld)) {
            deleteSingleFile($fileOld);
        }
        $newFileName = $path.'/'.time() . rand(1, 99) . uniqid() . '.' . $file->extension();
        if(!Storage::disk(env('FILESYSTEM_DRIVER'))->put($newFileName, fopen($file, 'r+'), 'public')) {
            return '';
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->url($newFileName);
    }
}

if (!function_exists('showFile')) {
    function showFile($fileName)
    {
        if (empty($fileName)) {
            $newFileName = config('const.image.imageNull');
        } else {
            $path = substr($fileName, strlen(env('AWS_URL').'/'));
            $newFileName = Storage::disk(env('FILESYSTEM_DRIVER'))->exists($path) ? $fileName : config('const.image.imageNull');
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
                $file_images[$key] = Storage::disk(env('FILESYSTEM_DRIVER'))->url($fileName);
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
        if (empty($fileNames)) {
            return false;
        }

        foreach ($fileNames as $key => $file) {
            $path = substr($file, strlen(env('AWS_URL').'/'));
            $fileNames[$key] = $path;
        }
        return Storage::disk(env('FILESYSTEM_DRIVER'))->delete($fileNames);
    }
}

