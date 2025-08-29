<?php

namespace Tests\Feature\Users;

use App\Models\User;
use App\Users\UserRole;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_admin_can_get_users()
    {
        $admin = User::factory()->create([
            'role' => UserRole::Admin->value
        ]);

        Sanctum::actingAs($admin);

        $response = $this->getJson('/api/users');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'
        ]);
    }

    public function test_non_admin_cannot_get_users()
    {
        $user = User::factory()->create([
            'role' => UserRole::User->value
        ]);

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/users');

        $response->assertStatus(403);
    }

    public function test_non_authenticated_cannot_get_users()
    {
        $response = $this->getJson('/api/users');

        $response->assertStatus(401);
    }
}
