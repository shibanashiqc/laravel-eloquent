<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponsController extends Controller
{

    public function SuccessResponse($data, $message = '', $code = 200)
    {
        return response()->json([
            'error' => false,
            'data' => $data,
            'message' => $message,
        ], $code);
    }

    public function ErrorResponse($message, $code = 400)
    {
        return response()->json([
            'error' => true,
            'data' => [],
            'message' => $message,
        ], $code);
    }

}
