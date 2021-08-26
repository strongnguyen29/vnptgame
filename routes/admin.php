<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

/* Backend route */
Route::middleware('auth')->group(function() {

    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    Route::resource('users', \App\Http\Controllers\Backend\UserController::class);

    Route::resource('roles', \App\Http\Controllers\Backend\RoleController::class);

    Route::get('posts/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('posts.categories');

    Route::resource('posts', \App\Http\Controllers\Backend\PostController::class);

    Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);

    // options
    Route::get('options', [\App\Http\Controllers\Backend\OptionController::class, 'options'])->name('options');
    Route::put('options', [\App\Http\Controllers\Backend\OptionController::class, 'updateOptions'])->name('options.update');
});
