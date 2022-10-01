<?php

namespace App\Services;

/**
 * Class FileHandleService.
 */
class FileHandleService
{

    public static function uploadImage($image, $publicPath)
    {


        if (file_exists(public_path($publicPath)) && is_dir(public_path($publicPath))) {
            $newImageName = self::renameFileToTimeStamp($image);
            $fullImagePath = $publicPath . "/" . $newImageName;
            $image->move(public_path($publicPath), $newImageName);
            return $fullImagePath;
        }
    }

    public static function deleteImageIfExists($imagePath)
    {
        if (file_exists(public_path($imagePath)) && is_file(public_path($imagePath))) {
            unlink(public_path($imagePath));
            return true;
        }
        return false;
    }

    public static function renameFileToTimeStamp($image)
    {
        return time() . "." . $image->getClientOriginalExtension();
    }
}
