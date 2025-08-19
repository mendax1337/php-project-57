<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaskStatus extends Model
{
    /** @use HasFactory<\Database\Factories\TaskStatusFactory> */
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * @phpstan-return HasMany<Task, static>
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(\App\Models\Task::class, 'status_id');
    }
}
