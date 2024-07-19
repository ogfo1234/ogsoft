<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HolidayResource;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SimpleEndpointController extends Controller
{
    public function get(Request $request)
    {
        return response()->json([
            'message' => 'Hello, World!'
        ]);
    }

    public function post(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|integer|min:1|max:10',
            'number2' => 'required|integer|min:1|max:10',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        return response()->json([
            'result' => $request->number + $request->number2
        ]);
    }
}
