<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//halaman public
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts/{post:slug}/image', [PostController::class, 'showImage'])->name('posts.image');

// Halaman Dashboard (sudah ada dari Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard/posts', [PostController::class, 'dashboardIndex'])->name('posts.dashboard.index');
    // Route untuk mengelola post (CRUD)
    Route::resource('dashboard/posts', PostController::class)->except(['index', 'show']);
    //route untuk mengelola categories
    Route::resource('dashboard/categories', CategoryController::class)->except(['show']);
});

require __DIR__ . '/auth.php';
