<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjectDetectionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/detect-object', [ObjectDetectionController::class, 'store']);
Route::get('/logs', [ObjectDetectionController::class, 'index']);
