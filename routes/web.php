<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\WelcomeController;

// ===== USER CONTROLLERS =====
use App\Http\Controllers\{
    ProfileController,
    MediaController,
    UserMediaListController,
    DramaController,
    ManhwaController,
    StatsController,
    OverviewController,
    DashboardController,
    BrowseController
};

// ===== ADMIN CONTROLLERS =====
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MediaAdminController;
use App\Http\Controllers\Admin\GenreAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;

/* ADMIN ROUTES */

Route::prefix('admin')->group(function () {

    // LOGIN ADMIN
    Route::get('/login', [AdminController::class, 'showLoginForm'])
        ->name('admin.login');

    Route::post('/login', [AdminController::class, 'login'])
        ->name('admin.login.submit');

    // PROTECTED ADMIN AREA
    Route::middleware(['auth', AdminMiddleware::class])
        ->name('admin.')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [AdminController::class, 'dashboard'])
                ->name('dashboard');

            // Media Admin
            Route::get('/media-admin', [MediaAdminController::class, 'index'])
                ->name('media.admin');
            
            Route::post('/media-admin', [MediaAdminController::class, 'store'])
                ->name('media.store');

            Route::put('/media-admin/{media}', [MediaAdminController::class, 'update'])
                ->name('media.update');

            Route::delete('/media-admin/{media}', [MediaAdminController::class, 'destroy'])
                ->name('media.destroy');

            Route::get('media-admin/{media}', [MediaAdminController::class, 'show']);

            // ===== GENRE ADMIN =====
            Route::get('/genre-admin', [GenreAdminController::class, 'index'])
                ->name('genre.index');
            
            Route::post('/genre-admin', [GenreAdminController::class, 'store'])
                ->name('genre.store');

            Route::put('/genre-admin/{genre}', [GenreAdminController::class, 'update'])
                ->name('genre.update');

            Route::delete('/genre-admin/{genre}', [GenreAdminController::class, 'destroy'])
                ->name('genre.destroy');

            Route::get('/genre-admin/{genre}', [GenreAdminController::class, 'show']);
            
            // USER MANAGEMENT
            Route::resource('users', UserController::class);

            // Logout
            Route::post('/logout', [AdminController::class, 'logout'])
                ->name('logout');
        });
});

/* PUBLIC ROUTES (NO AUTH) */

Route::get('/', [WelcomeController::class, 'index'])->name('home');

/* AUTHENTICATED USER ROUTES */

Route::middleware('auth')->group(function () {

    // ===== PROFILE =====
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // ===== OVERVIEW =====
    Route::get('/overview', [OverviewController::class, 'index'])
        ->name('media.overview');

    // ===== DRAMA =====
    Route::get('/drama', [DramaController::class, 'index'])
        ->name('drama.index');

    Route::get('/drama/{drama}', [DramaController::class, 'show'])->name('drama.show');
    // ===== MANHWA =====
    Route::get('/manhwa', [ManhwaController::class, 'index'])
        ->name('manhwa.index');

    Route::get('/manhwa/{manhwa}', [ManhwaController::class, 'show'])->name('manhwa.show');

    // ===== BROWSE =====
    Route::get('/browse/{type}', [BrowseController::class, 'index'])
        ->name('browse.index')
        ->whereIn('type', ['drama', 'manhwa']);

    // ===== USER MEDIA LIST =====
    Route::post('/user-media-list', [UserMediaListController::class, 'store']);
    Route::put('/user-media-list/{id}', [UserMediaListController::class, 'update']);
    Route::delete('/user-media-list/{id}', [UserMediaListController::class, 'destroy']);
    Route::get('/user-media-list/{id}', [UserMediaListController::class, 'show'])
        ->name('user-media-list.show');
    Route::get('/user-media-list/by-media/{mediaId}', [UserMediaListController::class, 'showByMedia']);

    // ===== DIARY =====
    Route::get('/diary', [UserMediaListController::class, 'diary'])
        ->name('diary.index');

    // ===== STATS =====
    Route::get('/stats', [StatsController::class, 'index'])
        ->name('stats.index');

    // ===== SEARCH =====
    Route::get('/search-media', [MediaController::class, 'search']);

    // ===== USER DASHBOARD =====
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/media/{media}', [MediaController::class, 'show'])
    ->name('media.show');

    Route::post('/media/{id}/toggle-list', [MediaController::class, 'toggleList'])
    ->middleware('auth')
    ->name('media.toggleList');

});

require __DIR__ . '/auth.php';
