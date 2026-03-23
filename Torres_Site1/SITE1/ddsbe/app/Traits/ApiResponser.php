<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ApiResponser
{
    // Standard Success Response
    public function successResponse($data, $code = Response::HTTP_OK)
    {
        return response()->json(['data' => $data], $code);
    }

    // Standard Error Response used by the Handler
    public function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}