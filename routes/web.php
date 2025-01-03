<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\UpvoteController;

Route::redirect('/', '/dashboard');

Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Verified Routes
    Route::middleware(['verified'])->group(function () {
        // Dashboard Route
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');

        // Feature Route
        Route::resource('feature',FeatureController::class);

        Route::post('/feature/{feature}/upvote', [UpvoteController::class,'store'])
            ->name('upvote.store');

        Route::delete('/upvote/{feature}', [UpvoteController::class,'destroy'])
            ->name('upvote.destroy');
    });
});

require __DIR__.'/auth.php';
