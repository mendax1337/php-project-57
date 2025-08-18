<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/** @extends Factory<Task> */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        return [
            'name'           => $this->faker->sentence(3),
            'description'    => $this->faker->optional()->paragraph(),
            'status_id'      => TaskStatus::query()->inRandomOrder()->value('id') ?? TaskStatus::factory(),
            'created_by_id'  => User::factory(),
            'assigned_to_id' => $this->faker->boolean(60) ? User::factory() : null,
        ];
    }
}
