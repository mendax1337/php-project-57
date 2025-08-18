<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    private const TASKS_INDEX = '/tasks';
    private const TASKS_CREATE = '/tasks/create';

    public function test_index_is_public(): void
    {
        $response = $this->get(self::TASKS_INDEX);
        $response->assertOk();
    }

    public function test_show_is_public(): void
    {
        $status = TaskStatus::factory()->create();
        $task = Task::factory()->create(['status_id' => $status->id]);

        $response = $this->get(route('tasks.show', $task));
        $response->assertOk();
    }

    public function test_guest_cannot_open_create(): void
    {
        $response = $this->get(self::TASKS_CREATE);
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_can_create_task(): void
    {
        $user   = User::factory()->create();
        $status = TaskStatus::factory()->create();
        $assignee = User::factory()->create();

        $response = $this->actingAs($user)->post(route('tasks.store'), [
            'name'           => 'Test Task',
            'description'    => 'desc',
            'status_id'      => $status->id,
            'assigned_to_id' => $assignee->id,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', [
            'name' => 'Test Task',
            'created_by_id' => $user->id,
        ]);
    }

    public function test_authenticated_can_update_task(): void
    {
        $user   = User::factory()->create();
        $status = TaskStatus::factory()->create();
        $task   = Task::factory()->create(['created_by_id' => $user->id, 'status_id' => $status->id]);

        $response = $this->actingAs($user)->patch(route('tasks.update', $task), [
            'name'           => 'Updated',
            'description'    => 'New',
            'status_id'      => $status->id,
            'assigned_to_id' => null,
        ]);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'name' => 'Updated']);
    }

    public function test_only_creator_can_delete(): void
    {
        $creator = User::factory()->create();
        $other   = User::factory()->create();
        $status  = TaskStatus::factory()->create();
        $task    = Task::factory()->create(['created_by_id' => $creator->id, 'status_id' => $status->id]);

        // Не создатель — 403
        $this->actingAs($other)
            ->delete(route('tasks.destroy', $task))
            ->assertForbidden();

        // Создатель — ок
        $this->actingAs($creator)
            ->delete(route('tasks.destroy', $task))
            ->assertRedirect(route('tasks.index'));

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
