<?php

namespace App\Services;

class ResponseService
{
    static function successResponse($payload = null, $statusCode = 200)
    {
        $response = [];
        $response["status"] = "success";
        $response["payload"] = $payload;
        // $response["authorisation"] = $authorisation;
        
        return response()->json([
                'status' => 'success',
                'payload' => $payload
            ], $statusCode);

    }

    static function failureResponse($message = null, $statusCode = 400)
    {

        $response = [];
        $response["status"] = "failure";
        $response["message"] = $message;

        return response()->json([
                'status' => 'failure',
                'message' => $message
            ], $statusCode);
    }
}
