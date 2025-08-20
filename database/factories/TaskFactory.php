<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(),
            'description' => fake()->sentence(10),
            'status_id' => TaskStatus::inRandomOrder()->first(),
            'created_by_id' => User::inRandomOrder()->first(),
            'assigned_to_id' => User::inRandomOrder()->first(),
        ];
    }
}
