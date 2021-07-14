<?php

namespace App\Traits;

use Illuminate\Http\Response;

/**
 * 
 */
trait ApiResponse
{
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json([
            'data' => $data
        ], $code);
    }

    public function errorResponse($message, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'code' => $code,
            'error' => $message,
        ], $code);
    }
}
