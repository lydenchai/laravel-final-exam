<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommetController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// User Public Route
Route::get('/user_post_comments', [UserController::class ,'index']);
Route::get('/users/{id}', [UserController::class ,'show']);

// User Private Route
Route::post('/users', [UserController::class ,'store']);
Route::put('/users/{id}', [UserController::class ,'update']);
Route::delete('/users/{id}', [UserController::class ,'destroy']);

// ========================================================================
// Post Public Route
Route::get('/post_comments', [PostController::class ,'index']);
Route::get('/posts/{id}', [PostController::class ,'show']);

// Post Private Route
Route::post('/posts', [PostController::class ,'store']);
Route::put('/posts/{id}', [PostController::class ,'update']);
Route::delete('/posts/{id}', [PostController::class ,'destroy']);

// ========================================================================
// Comment Public Route
Route::get('/comments', [CommetController::class ,'index']);
Route::get('/comments/{id}', [CommetController::class ,'show']);

// Comment Private Route
Route::post('/comments', [CommetController::class ,'store']);
Route::put('/comments/{id}', [CommetController::class ,'update']);
Route::delete('/comments/{id}', [CommetController::class ,'destroy']);