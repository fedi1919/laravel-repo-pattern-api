<?php

namespace App\Traits;

trait GlobalTrait
{

    protected function success($message = null, $code, $data = null)
    {
        $jsonResponse = [
            "status" => $message,
            "message" => "Request was successful",
        ];

        if ($data) {
            $jsonResponse['data'] = $data;
        }

        return response()->json($jsonResponse, $code);
    }

    protected function error($message, $code)
    {
        return response()->json([
            'status' => 'An error has occurred',
            'message' => $message
        ], $code);
    }
}
