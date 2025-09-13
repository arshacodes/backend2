<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

Route::get('/hello-world', function () {
    return response([
        'data' => "Hello World"
    ], 200);
});

Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});