<?php

use App\Http\Controllers\Api\SimpleEndpointController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\WorkingDaysController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::get('/simple-endpoint', [SimpleEndpointController::class, 'get'])->name('simple-endpoint.get');
    Route::post('/simple-endpoint', [SimpleEndpointController::class, 'post'])->name('simple-endpoint.post');
    Route::get('/working-day', [WorkingDaysController::class, 'index'])->name('working-days.index');
    Route::get('/task', [TaskController::class, 'index'])->name('task.index');
});
