<?php

namespace App\Services;

class ResponseService
{
    static function successResponse($payload = null, $statusCode = 200)
    {
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $payload;

        return json_encode($response, $statusCode);
    }

    static function failureResponse($message = null, $statusCode = 400)
    {

        $response = [];
        $response["status"] = "failure";
        $response["message"] = $message;

        return json_encode($response, $statusCode);
    }
}
