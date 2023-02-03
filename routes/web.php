<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/blog-post',[PostController::class,'index'])->name('blog-post');
// Route::get('/blog-post',[PostController::class,'show']);

Auth::routes();
