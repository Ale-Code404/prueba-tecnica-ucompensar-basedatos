<?php

namespace Tests\Feature\Movies;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetMoviesTest extends TestCase
{
    public function test_cannot_get_movies_without_authentication(): void
    {
        $response = $this->getJson('/api/movies');

        $response->assertStatus(401);
    }

    public function test_can_get_movies_with_authentication(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/movies?search=world');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'
        ]);
    }

    public function test_can_get_movies_with_pagination(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/movies?search=a&page=1');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
            'meta' => [
                'total',
                'from',
                'to'
            ]
        ]);
    }
}
