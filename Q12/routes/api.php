<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/', [PostController::class, 'store']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'destroy']);
    Route::patch('/{id}/activate', [PostController::class, 'setActive']);
    Route::patch('/{id}/deactivate', [PostController::class, 'setInactive']);
    Route::patch('/{id}/order', [PostController::class, 'setOrder']);
});