<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

Route::get('/ve-chung-toi', [App\Http\Controllers\Frontend\HomeController::class, 'aboutUs'])->name('about');

Route::get('/dich-vu', [App\Http\Controllers\Frontend\HomeController::class, 'ourServices'])->name('services');

Route::get('/lien-he', [App\Http\Controllers\Frontend\HomeController::class, 'contactUs'])->name('contact');

// Posts
Route::get('/tin-tuc', [App\Http\Controllers\Frontend\PostController::class, 'index'])->name('posts.index');
Route::get('/tin-tuc/{slug}', [App\Http\Controllers\Frontend\PostController::class, 'postDetail'])->name('posts.detail');

// Tuyen dung
Route::get('/tuyen-dung', [App\Http\Controllers\Frontend\RecruitmentController::class, 'index'])->name('recruitments.index');
Route::get('/tuyen-dung/{slug}', [App\Http\Controllers\Frontend\RecruitmentController::class, 'detail'])->name('recruitments.detail');
Route::post('/tuyen-dung/apply', [App\Http\Controllers\Frontend\RecruitmentController::class, 'storeApply'])->name('recruitments.apply');

Route::get('language-change', [\App\Http\Controllers\Frontend\HomeController::class, 'languageChange'])->name('languageChange');

