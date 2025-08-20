<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;

    /**
     * Properties.
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all tasks with the status.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'status_id');
    }
}
