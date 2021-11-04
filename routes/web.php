<?php

use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Http\Controllers\PostController;

Route::get('/', function () {
	return view('posts');
});

Route::get('/show', [PostController::class, 'show']);

Route::post('/insert', [PostController::class, 'create']);

Route::post('/delete', [PostController::class, 'delete']);

Route::post('/update', [PostController::class, 'update']);