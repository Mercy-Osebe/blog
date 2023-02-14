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
    Route::get('/admin/post/index',[PostController::class,'index'])->name('post.index');

    //for creating a post and adding the data into the database.
    Route::get('/admin/post/create',[PostController::class,'create'])->name('post.create');
    Route::post('/admin/post/create',[PostController::class,'store'])->name('post.store');
    
    //deleting a post
    // Route::delete('/admin/post/{id}',[PostController::class,'destroy'])->middleware('can: view,Post')->name('post.destroy');
    Route::delete('/admin/post/{id}',[PostController::class,'destroy'])->name('post.destroy');

    // for editing a post
    Route::get('/admin/post/{id}/edit',[PostController::class,'edit'])->name('post.edit');
    Route::put('/admin/post/{id}',[PostController::class,'update'])->name('post.update');

    Route::resource('/res',PostController::class);

    // Route::post('/admin/post/create',[PostController::class,'store'])->name('post.store');

});

// Route::get('/admin/post/{id}/edit',[PostController::class,'edit'])->middleware('can:view,Post')->name('post.edit');
Auth::routes();
