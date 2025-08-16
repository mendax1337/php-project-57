<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\TaskStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаём тестового пользователя напрямую
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'), // пароль: password
            ]
        );

        // Начальные статусы задач
        $statuses = [
            'new',
            'in progress',
            'testing',
            'done',
        ];

        foreach ($statuses as $status) {
            TaskStatus::updateOrCreate(['name' => $status]);
        }
    }
}
