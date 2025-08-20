<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    use HasFactory;

    /**
     * Properties.
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Get all tasks with the status.
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
}
