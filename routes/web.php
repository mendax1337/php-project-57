<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskStatusController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

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

Route::get('/__debug_db', function () {
    try {
        $default = config('database.default');
        $conn = config("database.connections.$default");

        $users = DB::table('users')->count();
        $statuses = DB::table('task_statuses')->count();

        // Проверим версию сервера и текущую БД (для Postgres)
        $serverVersion = DB::select('select version() as v')[0]->v ?? null;
        $currentDb = null;
        if (($conn['driver'] ?? null) === 'pgsql') {
            $currentDb = DB::select('select current_database() as db')[0]->db ?? null;
        }

        return response()->json([
            'env' => app()->environment(),
            'app_url' => config('app.url'),
            'database' => [
                'default' => $default,
                'driver' => $conn['driver'] ?? null,
                'host' => $conn['host'] ?? null,
                'database' => $conn['database'] ?? $currentDb,
                'url_env' => env('DATABASE_URL') ? 'SET' : 'MISSING',
            ],
            'counts' => [
                'users' => $users,
                'task_statuses' => $statuses,
            ],
            'server' => [
                'version' => $serverVersion,
            ],
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ], 500);
    }
});

require __DIR__ . '/auth.php';
