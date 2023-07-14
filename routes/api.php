<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);
Route::post('add', [TodoController::class, 'add']);
Route::post('update', [TodoController::class, 'update']);
Route::post('show', [TodoController::class, 'show']);
Route::post('completed', [TodoController::class, 'completed']);
Route::post('delete', [TodoController::class, 'delete']);