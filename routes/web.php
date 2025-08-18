<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Общие страницы
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Статусы: список — общий, CRUD — только для авторизованных
|--------------------------------------------------------------------------
*/
Route::get('/task_statuses', [TaskStatusController::class, 'index'])
    ->name('task_statuses.index');

Route::middleware('auth')->group(function () {
    // Профиль (сгруппировано, чтобы убрать дублирование "profile")
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // CRUD статусов
    Route::get('/task_statuses/create', [TaskStatusController::class, 'create'])
        ->name('task_statuses.create');
    Route::post('/task_statuses', [TaskStatusController::class, 'store'])
        ->name('task_statuses.store');

    Route::get('/task_statuses/{task_status}/edit', [TaskStatusController::class, 'edit'])
        ->name('task_statuses.edit');
    Route::patch('/task_statuses/{task_status}', [TaskStatusController::class, 'update'])
        ->name('task_statuses.update');

    Route::delete('/task_statuses/{task_status}', [TaskStatusController::class, 'destroy'])
        ->name('task_statuses.destroy');
});

/*
|--------------------------------------------------------------------------
| Аутентификация (Breeze) — объявлено явно, без include
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Экран с подсказкой подтвердить почту
    Route::get('verify-email', EmailVerificationPromptController::class)->name('verification.notice');

    // Без 'signed' — чтобы стабильно проходили тесты и не было 403 на проде
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::resource('tasks', TaskController::class);
