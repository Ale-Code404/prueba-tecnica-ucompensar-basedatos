<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Users\UserRole;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create([
            'role' => UserRole::User->value
        ]);

        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'token'
        ]);
    }
}
