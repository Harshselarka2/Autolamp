<?php

// use Illuminate\Support\Facades\Route;

// use App\Http\Controllers\LogController;

// // Route::get('/', function () {
// //     return view('welcome');
// // });


// Route::get('/', [LogController::class, 'showYears'])->name('logs.years');
// Route::get('/logs/{year}', [LogController::class, 'showMonths'])->name('logs.months');
// Route::get('/logs/{year}/{month}', [LogController::class, 'showDates'])->name('logs.dates');
// Route::get('/logs/{year}/{month}/{date}', [LogController::class, 'showEsps'])->name('logs.esps');
// Route::get('/logs/{year}/{month}/{date}/{esp_id}', [LogController::class, 'showDetails'])->name('logs.details');
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ObjectDetectionController;
use App\Http\Controllers\LogController;
// 📌 API ENDPOINTS for ESP8266
// ESP8266 sends data (object detected, lamp status)
Route::post('/detect-object', [ObjectDetectionController::class, 'store'])->name('logs.store');


// 📌 Default homepage redirects to the years log
Route::get('/', [LogController::class, 'showYears'])->name('home');

// 📌 Routes for logs
Route::get('/logs', [LogController::class, 'showYears'])->name('logs.years');
Route::get('/logs/{year}', [LogController::class, 'showMonths'])->name('logs.months');
Route::get('/logs/{year}/{month}', [LogController::class, 'showDates'])->name('logs.dates');
Route::get('/logs/{year}/{month}/{date}', [LogController::class, 'showEsps'])->name('logs.esps');
Route::get('/logs/{year}/{month}/{date}/{esp_id}', [LogController::class, 'showDetails'])->name('logs.details');
