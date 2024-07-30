<?php

namespace App\Http\Controllers\Api;

use App\Classes\Date;
use App\Classes\Task;
use App\Classes\WorkingTime;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'start_date' => 'required|date',
            'duration' => 'required|integer',
            'working_time_start' => 'required|date_format:H:i',
            'working_time_end' => 'required|date_format:H:i',
            'include_holidays' => 'boolean'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()
            ], 400);
        }

        $task = new Task(
            $request->input('name', 'Task'),
            new Date($request->input('start_date')),
            $request->input('duration'),
            new WorkingTime(
                $request->input('working_time_start'),
                $request->input('working_time_end')
            ),
            $request->input('include_holidays', false)
        );

        return response()->json([
            'due_date' => $task->getEndDate()
        ]);
    }
}
