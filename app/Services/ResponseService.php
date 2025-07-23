<?php

namespace App\Services;

class ResponseService
{
    static function successResponse($payload = null, $statusCode = 200, $authorisation = null, $extra = [])
    {
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $payload;
        $response["authorisation"] = $authorisation;
        
        $response = array_merge($response, $extra);

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
