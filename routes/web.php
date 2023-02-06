<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/blog-post',[PostController::class,'index'])->name('blog-post');
// Route::get('/blog-post',[PostController::class,'show']);

//protecting our admin path
Route::middleware('auth')->group(function(){
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
    Route::get('/admin/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/admin/post/create',[PostController::class,'store'])->name('post.store');
});

Auth::routes();
