<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::resource('posts', PostController::class);

Route::post('/login', SessionController::class);

Route::get('/posts', [PostController::class, 'index']);
Route::post('/posts', [PostController::class, 'create']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::patch('/posts/{id}', [PostController::class, 'update']); // update vote
Route::delete('/posts/{id}', [PostController::class, 'delete']);
Route::get('/posts/{id}', [PostController::class, 'show']);


// Route::get('/posts/{id}/tags', [PostController::class, 'tags']);
Route::get('/posts/{id}/comments', [PostController::class, 'comments']);



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


