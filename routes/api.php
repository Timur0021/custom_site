<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/files', [\App\Http\Controllers\Api\FileController::class, 'index']);
    Route::post('/files', [\App\Http\Controllers\Api\FileController::class, 'store']);
    Route::get('/files/{id}', [\App\Http\Controllers\Api\FileController::class, 'show']);
    Route::put('/files/{id}', [\App\Http\Controllers\Api\FileController::class, 'update']);
    Route::delete('/files/{id}', [\App\Http\Controllers\Api\FileController::class, 'destroy']);
    Route::get('/files/{id}/download', [\App\Http\Controllers\Api\FileController::class, 'download']);
});
Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
