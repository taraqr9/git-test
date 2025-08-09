<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LookController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('looks', LookController::class);
    Route::resource('comments', CommentController::class)->only(['store', 'destroy']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::get('/logout', [UserController::class, 'logout']);
});
