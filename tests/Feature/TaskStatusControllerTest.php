<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_is_public(): void
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertStatus(200);
    }

    public function test_guest_cannot_open_create(): void
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_can_create_status(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Используем имя, которого нет среди сидированных статусoв
        $response = $this->post(route('task_statuses.store'), [
            'name' => 'дополнительный статус',
        ]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['name' => 'дополнительный статус']);
    }

    public function test_authenticated_can_update_status(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $status = TaskStatus::factory()->create(['name' => 'старое']);

        $response = $this->patch(route('task_statuses.update', $status), [
            'name' => 'обновлённое',
        ]);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', ['id' => $status->id, 'name' => 'обновлённое']);
    }

    public function test_authenticated_can_delete_status(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $status = TaskStatus::factory()->create();

        $response = $this->delete(route('task_statuses.destroy', $status));
        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseMissing('task_statuses', ['id' => $status->id]);
    }

    public function test_status_in_use_cannot_be_deleted(): void
    {
        $user = \App\Models\User::factory()->create();
        $this->actingAs($user);

        $status = \App\Models\TaskStatus::factory()->create();
        \App\Models\Task::factory()->create([
            'status_id' => $status->id,
            'created_by_id' => $user->id,
        ]);

        $response = $this->delete(route('task_statuses.destroy', $status));
        $response->assertRedirect(route('task_statuses.index'));
        $response->assertSessionHas('error', 'Не удалось удалить статус');

        $this->assertDatabaseHas('task_statuses', ['id' => $status->id]);
    }

}
