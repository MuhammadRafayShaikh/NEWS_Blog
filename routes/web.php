<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserValid;
use Illuminate\Support\Facades\Route;


Route::resource('users', UserController::class)->middleware('userValid')->middleware('can:isAdmin');

Route::resource('category', CategoryController::class)->middleware('userValid')->middleware('can:isAdmin');

Route::resource('posts', PostController::class)->middleware('userValid');

Route::delete('/posts/{id}/{catid}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::get('loginPage', [AuthController::class, 'loginPage'])->name('loginPage');

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard')->middleware('userValid')->middleware('can:isAdmin');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


// Frontend Routes

Route::get('/', [FrontController::class, 'post'])->name('home');

Route::get('single/{id}', [FrontController::class, 'singlePost'])->name('singlePost');

Route::get('allcategory/{id}', [FrontController::class, 'category'])->name('allcategory');

Route::get('allusers/{id}', [FrontController::class, 'users'])->name('allusers');

Route::get('recentPosts', [FrontController::class, 'recentPosts'])->name('recentPosts');

Route::get('/allCategory', [FrontController::class, 'allCategory'])->name('allCategory');

Route::get('/search', [FrontController::class, 'search'])->name('search');
