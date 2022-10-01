<?php

namespace App\Services;

/**
 * Class ResponseService.
 */
class ResponseService
{


    public static function json($data, $message = null, $statusCode = 200)
    {

        $response["data"] = $data;
        $response["message"] = $message;

        return response()->json($data, $statusCode);
    }
}
