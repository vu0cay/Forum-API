<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TagController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [SessionController::class, 'login']);
Route::post('/logout', [SessionController::class, 'logout'])->middleware('auth:sanctum');


Route::get('/posts', [PostController::class, 'index']);
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/posts', [PostController::class, 'store']);
    Route::put('/posts/{id}', [PostController::class, 'update']);
    Route::patch('/posts/{id}', [PostController::class, 'update']);
    Route::delete('/posts/{id}', [PostController::class, 'delete']);
});

Route::get('/posts/{id}', [PostController::class, 'show']);

// Route::get('/posts/{id}/tags', [PostController::class, 'tags']);
Route::get('/posts/{id}/comments', [PostController::class, 'comments']);
Route::get('/tags/{tag:name}', TagController::class);
Route::get('/search', SearchController::class);


Route::get('/user', [SessionController::class, 'user'])->middleware('auth:sanctum');




