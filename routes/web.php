<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Статусы: список доступен всем, остальное только для авторизованных
Route::get('/task_statuses', [TaskStatusController::class, 'index'])
    ->name('task_statuses.index');

Route::middleware('auth')->group(function () {
    // Профиль
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

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

require __DIR__ . '/auth.php';
