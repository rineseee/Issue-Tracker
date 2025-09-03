<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (auth + verified)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authenticated
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Resources
    Route::resource('projects', ProjectController::class);
    Route::resource('issues', IssueController::class);
    Route::resource('tags', TagController::class);
    Route::resource('comments', CommentController::class);
});

// Comments
Route::post('/issues/{issue}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/issues/{issue}/comments', [CommentController::class, 'index'])->name('comments.index');

// Auth
require __DIR__ . '/auth.php';
