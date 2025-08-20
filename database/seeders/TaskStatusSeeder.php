<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [
            ['name' => 'новый'],
            ['name' => 'в работе'],
            ['name' => 'на тестировании'],
            ['name' => 'завершен'],
        ];

        TaskStatus::factory()
            ->count(count($seeders))
            ->sequence(...$seeders)
            ->create();
    }
}
