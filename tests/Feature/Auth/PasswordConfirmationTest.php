<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasswordConfirmationTest extends TestCase
{
    use RefreshDatabase;

    /** Общий путь для подтверждения пароля */
    private const CONFIRM_PASSWORD_URI = '/confirm-password';

    public function test_confirm_password_screen_can_be_rendered(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(self::CONFIRM_PASSWORD_URI);

        $response->assertStatus(200);
    }

    public function test_password_can_be_confirmed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(self::CONFIRM_PASSWORD_URI, [
            'password' => 'password',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function test_password_is_not_confirmed_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(self::CONFIRM_PASSWORD_URI, [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
    }
}
