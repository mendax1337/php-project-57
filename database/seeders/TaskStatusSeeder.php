<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['новый', 'в работе', 'на тестировании', 'завершен'];

        foreach ($names as $name) {
            TaskStatus::firstOrCreate(['name' => $name]);
        }
    }
}
