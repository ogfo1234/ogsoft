<?php

namespace App\Http\Controllers\Api;

use App\Classes\Date;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class WorkingDaysController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'countries' => 'array:SK,CZ'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $date = new Date($request->input('date'));
        $countries = $request->input('country', null);

        if ($countries) {
            $countries = Str::of($countries)->explode(',');
        }

        return response()->json([
            'is_working_day' => $date->isWorkingDay($countries),
            'is_weekend' => $date->isWeekend(),
            'is_holiday' => $date->isHoliday($countries)
        ]);
    }
}
