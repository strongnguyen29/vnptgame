<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

/* Backend route */
Route::middleware('auth')->group(function() {

    Route::get('/', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('dashboard');

    // User, Role, permission
    Route::resource('users', \App\Http\Controllers\Backend\UserController::class);
    Route::resource('roles', \App\Http\Controllers\Backend\RoleController::class);

    // Post
    Route::get('posts/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('posts.categories');
    Route::resource('posts', \App\Http\Controllers\Backend\PostController::class)->except('show');

    // Post
    Route::get('recruitments/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('recruitments.categories');
    Route::resource('recruitments', \App\Http\Controllers\Backend\RecruitmentController::class)->except('show');
    Route::get('recruitments/applies', [\App\Http\Controllers\Backend\RecruitmentController::class, 'showApplies'])->name('recruitments.applies');
    Route::get('recruitments/applies/{id}/download', [\App\Http\Controllers\Backend\RecruitmentController::class, 'downloadApplyCV'])
        ->name('recruitments.applies.download');

    // Category
    Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);

    // options
    Route::get('options', [\App\Http\Controllers\Backend\OptionController::class, 'options'])->name('options');
    Route::put('options', [\App\Http\Controllers\Backend\OptionController::class, 'updateOptions'])->name('options.update');
});
