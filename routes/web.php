<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\TwoFactorController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ───────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', fn() => view('public.about'))->name('about');
Route::get('/resume', fn() => view('public.resume'))->name('resume');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ─── Admin Routes ─────────────────────────────────────────
Route::middleware(['auth', 'verified', 'require2fa'])
    ->prefix(env('ADMIN_PREFIX', 'admin'))
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn() => view('dashboard'))->name('dashboard');
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // 2FA routes
        Route::withoutMiddleware('require2fa')->group(function () {
            Route::get('/2fa/setup', [TwoFactorController::class, 'setup'])->name('2fa.setup');
            Route::post('/2fa/enable', [TwoFactorController::class, 'enable'])->name('2fa.enable');
            Route::get('/2fa/challenge', [TwoFactorController::class, 'challenge'])->name('2fa.challenge');
            Route::post('/2fa/verify', [TwoFactorController::class, 'verify'])->name('2fa.verify');
            Route::post('/2fa/disable', [TwoFactorController::class, 'disable'])->name('2fa.disable');
        });

        // Projects
        Route::resource('projects', AdminProjectController::class)->except(['show']);

        // Placeholder route'lar
        Route::get('/messages', fn() => view('dashboard'))->name('messages.index');
        Route::get('/experience', fn() => view('dashboard'))->name('experience.index');
        Route::get('/education', fn() => view('dashboard'))->name('education.index');
        Route::get('/settings', fn() => view('dashboard'))->name('settings.index');
    });

require __DIR__.'/auth.php';