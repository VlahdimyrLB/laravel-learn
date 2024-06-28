<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [JobController::class, 'index']);

Route::get('/register', [RegisteredController::class, 'create']);
Route::post('/register', [RegisteredController::class, 'store']);

Route::get('/login', [SessionController::class, 'create']);
Route::post('/login', [SessionController::class, 'store']);
Route::delete('/logout', [SessionController::class, 'destroy']);
