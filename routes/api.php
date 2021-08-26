<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->group(function () {

    Route::post('/upload/image', [\App\Http\Controllers\Api\UploadController::class, 'uploadImage'])->name('upload.image');

    Route::get('/categories/tree', [\App\Http\Controllers\Api\CategoryController::class, 'getTree'])->name('categories.tree');

    Route::put('/categories/active', [\App\Http\Controllers\Api\CategoryController::class, 'active'])->name('categories.active');

    Route::put('/home/projects/sort', [\App\Http\Controllers\Api\OptionController::class, 'homeProjectsSort'])->name('home.projects.sort');

    Route::put('/home/posts/sort', [\App\Http\Controllers\Api\OptionController::class, 'homePostsSort'])->name('home.posts.sort');
    Route::put('/slides/sort', [\App\Http\Controllers\Api\SlideController::class, 'sortOrder'])->name('slides.sort');

    Route::delete('/medias/delete', [\App\Http\Controllers\Api\MediaController::class, 'delete'])->name('medias.delete');
});
