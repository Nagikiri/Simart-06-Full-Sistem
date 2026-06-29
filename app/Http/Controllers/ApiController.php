<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Base API response
     */
    protected function response($data = null, $message = 'Success', $code = 200)
    {
        return response()->json([
            'success' => $code >= 200 && $code < 300,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    /**
     * Error response
     */
    protected function errorResponse($message = 'Error', $code = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
}
