<?php

namespace Tests\Feature\Movies;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetMovieFavoritesTest extends TestCase
{
    public function test_cannot_get_movie_favorites_without_authentication(): void
    {
        $response = $this->getJson('/api/favorites');

        $response->assertStatus(401);
    }

    public function test_can_get_movie_favorites_with_authentication(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/favorites');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'title',
                    'description',
                    'year'
                ]
            ]
        ]);
    }
}
