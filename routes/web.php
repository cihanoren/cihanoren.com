<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\TwoFactorController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ExperienceController as AdminExperienceController;
use App\Http\Controllers\Admin\EducationController as AdminEducationController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ───────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/resume', [HomeController::class, 'resume'])->name('resume');
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

        // Experience
        Route::resource('experience', AdminExperienceController::class)->except(['show']);

        // Education
        Route::resource('education', AdminEducationController::class)->except(['show']);

        // Messages
        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{message}/read', [AdminMessageController::class, 'markRead'])->name('messages.read');
        Route::post('/messages/{message}/unread', [AdminMessageController::class, 'markUnread'])->name('messages.unread');
        Route::post('/messages/{message}/archive', [AdminMessageController::class, 'archive'])->name('messages.archive');
        Route::post('/messages/{message}/unarchive', [AdminMessageController::class, 'unarchive'])->name('messages.unarchive');
        Route::post('/messages/{message}/reply', [AdminMessageController::class, 'reply'])->name('messages.reply');
        Route::delete('/messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        // Settings placeholder
        Route::get('/settings', fn() => view('dashboard'))->name('settings.index');
    });

require __DIR__.'/auth.php';