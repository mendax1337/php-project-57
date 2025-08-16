<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        if (! DB::getSchemaBuilder()->hasTable('task_statuses')) {
            return;
        }

        $now = now();

        // Нужные названия как в демо
        $rows = [
            ['name' => 'новый',       'created_at' => $now, 'updated_at' => $now],
            ['name' => 'завершен',   'created_at' => $now, 'updated_at' => $now],
            ['name' => 'в работе', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'на тестировании',    'created_at' => $now, 'updated_at' => $now],
        ];

        // upsert по name — не даст создать дубликаты при повторных деплоях
        DB::table('task_statuses')->upsert($rows, ['name'], ['updated_at']);
    }

    public function down(): void
    {
        // Ничего не удаляем — данные оставляем
    }
};
