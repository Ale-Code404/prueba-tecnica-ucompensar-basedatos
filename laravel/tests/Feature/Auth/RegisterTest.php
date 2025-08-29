<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_user_can_register(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Testing now!',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'role',
                'created_at'
            ]
        ]);
    }

    public function test_user_cannot_register_with_existing_email(): void
    {
        $this->postJson('/api/auth/register', [
            'name' => 'Testing now!',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response = $this->postJson('/api/auth/register', [
            'name' => 'Testing now!',
            'email' => 'test@example.com',
            'password' => 'password'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('email');
    }

    public function test_user_cannot_register_with_invalid_password(): void
    {
        $response = $this->postJson('/api/auth/register', [
            'name' => 'Testing now!',
            'email' => 'test@example.com',
            'password' => 'short'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrorFor('password');
    }
}
