<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\UserMediaListController;
use App\Http\Controllers\DramaController;
use App\Http\Controllers\ManhwaController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\OverviewController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/drama/browse', function () {
    return view('drama.browse');
})->name('drama.browse');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/drama', [DramaController::class, 'index'])->name('drama.index');
    Route::get('/drama/browse', [DramaController::class, 'browse'])->name('drama.browse');
    Route::get('/manhwa', [ManhwaController::class, 'index'])->name('manhwa.index');
    Route::get('/overview', [OverviewController::class, 'index'])->name('media.overview');
    
    // User Media List
    Route::post('/user-media-list', [UserMediaListController::class, 'store']);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/stats', [StatsController::class, 'index'])->name('media.stats');
});

Route::get('/search-media', [MediaController::class, 'search'])
    ->middleware('auth');

require __DIR__.'/auth.php';