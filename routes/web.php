<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/logout', [LoginController::class, 'logout']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware('auth')->group(function () {
    Route::prefix('categories')->name('category.')->group(function () {
        Route::resource('/categories', CategoryController::class);
    });
    Route::prefix('tags')->name('tag.')->group(function () {
        Route::resource('/tags', TagController::class);
    });
    Route::prefix('posts')->name('post.')->group(function () {
        Route::resource('/posts', PostController::class);
    });
});
