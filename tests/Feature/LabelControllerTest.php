<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Label;
use App\Models\TaskStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LabelControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex(): void
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreateForGuest(): void
    {
        $response = $this->get(route('labels.create'));
        $response->assertForbidden();
    }

    public function testCreate(): void
    {
        $response = $this->actingAs($this->user)->get(route('labels.create'));
        $response->assertOk();
    }

    public function testEditForGuest(): void
    {
        $label = Label::factory()->create();
        $response = $this->get(route('labels.edit', $label));
        $response->assertForbidden();
    }

    public function testEdit(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->get(route('labels.edit', $label));
        $response->assertOk();
    }

    public function testStoreForGuest(): void
    {
        $data = Label::factory()->make()->only('name');
        $response = $this->post(route('labels.store', $data));
        $response->assertForbidden();
        $this->assertDatabaseMissing('labels', $data);
    }

    public function testStore(): void
    {
        $data = Label::factory()->make()->only('name');
        $response = $this->actingAs($this->user)->post(route('labels.store', $data));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testUpdateForGuest(): void
    {
        $label = Label::factory()->create();
        $data = Label::factory()->make()->only('name');
        $response = $this->patch(route('labels.update', $label), $data);
        $response->assertForbidden();
        $this->assertDatabaseMissing('labels', $data);
    }

    public function testUpdate(): void
    {
        $label = Label::factory()->create();
        $data = Label::factory()->make()->only('name');
        $response = $this->actingAs($this->user)->patch(route('labels.update', $label), $data);
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseHas('labels', $data);
    }

    public function testDeleteForGuest(): void
    {
        $label = Label::factory()->create();
        $response = $this->delete(route('labels.destroy', $label));
        $response->assertForbidden();
        $this->assertDatabaseHas('labels', ['id' => $label['id']]);
    }

    public function testDelete(): void
    {
        $label = Label::factory()->create();
        $response = $this->actingAs($this->user)->delete(route('labels.destroy', $label));
        $response->assertSessionHasNoErrors();
        $response->assertRedirect();
        $this->assertDatabaseMissing('labels', ['id' => $label['id']]);
    }
}
