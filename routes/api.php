<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::post('/shorturl', [UrlController::class, 'store'])->name('shorturl');
});


//Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
