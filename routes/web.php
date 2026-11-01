<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Only logged in users can upload a photo. These routes are registered before
    // the public ones so /photos/create is not mistaken for /photos/{photo}.
    Route::get('/my-photos', [PhotoController::class, 'mine'])->name('photos.mine');
    Route::resource('photos', PhotoController::class)->only(['create', 'store']);
});

Route::resource('photos', PhotoController::class)->only(['index', 'show']);

require __DIR__.'/auth.php';
