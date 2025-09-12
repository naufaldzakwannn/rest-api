<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/posts', [PostController::class, 'index'])->middleware(['auth:sanctum']);

Route::get('/posts/{id}', [PostController::class, 'show'])->middleware(['auth:sanctum']);

Route::get('/posts2/{id}', [PostController::class, 'show2']);

Route::get('/csrf-token', function () {
    return response()->json(['token' => csrf_token()]);
});

Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/logout', [AuthenticationController::class, 'logout'])->middleware(['auth:sanctum']);
Route::get('/me', [AuthenticationController::class, 'me'])->middleware(['auth:sanctum']);
