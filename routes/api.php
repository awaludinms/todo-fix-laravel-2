<?php

use App\Http\Controllers\API\TodosController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('register', function () {
    return "test";
});

Route::get('crsf_token', function () {
    // header('Access-Control-Allow-Origin: *');
    // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

    return response()->json(['crsf_token' => csrf_token()]);
});

// Route::middleware(\Illuminate\Http\Middleware\HandleCors::class)->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
// });
Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('todo', TodosController::class);
});
