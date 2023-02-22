<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(PostController::class)->prefix('post')->group(function () {
    Route::get('/all', 'index');
    Route::get('/{postId}', 'show');
    Route::get('/user/{userId}', 'userPosts');
    Route::get('/category/{categoryId}', 'categoryPosts');
    Route::get('/brand/{brandId}', 'brandPosts');
    Route::get('/search/{searchWord}', 'search');
    Route::post('/', 'store');
    Route::patch('/update/{postId}', 'update');
    Route::delete('/delete/{id}', 'destroy');
});
