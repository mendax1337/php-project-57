<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (! Schema::hasTable('task_statuses')) {
            return;
        }

        $now   = now();
        $names = ['новый', 'завершен', 'в работе', 'на тестировании'];

        $rows = array_map(static fn (string $name) => [
            'name'       => $name,
            'created_at' => $now,
            'updated_at' => $now,
        ], $names);

        DB::table('task_statuses')->upsert($rows, ['name'], ['updated_at']);
    }

    public function down(): void
    {
        if (! Schema::hasTable('task_statuses')) {
            return;
        }

        DB::table('task_statuses')->whereIn('name', [
            'новый', 'завершен', 'в работе', 'на тестировании',
        ])->delete();
    }
};
