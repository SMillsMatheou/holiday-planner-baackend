<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ActivityDateController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
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


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    Route::post('/activity', [ActivityController::class, 'create']);
    Route::put('/activity/{id}', [ActivityController::class, 'update']);
    Route::get('/activity/{id}', [ActivityController::class, 'get']);
    Route::get('/activity', [ActivityController::class, 'list']);
    Route::post('/activity/join/{id}', [ActivityController::class, 'join']);

    Route::post('/activity/{id}/add-date', [ActivityDateController::class, 'create']);
    Route::get('/activity/{id}/dates', [ActivityDateController::class, 'getByActivity']);
    Route::delete('/activity-date/{id}', [ActivityDateController::class, 'delete']);
});


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
