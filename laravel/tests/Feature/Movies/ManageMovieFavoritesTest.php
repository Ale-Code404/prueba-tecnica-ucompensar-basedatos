<?php

namespace Tests\Feature\Movies;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ManageMovieFavoritesTest extends TestCase
{
    public function test_cannot_add_movie_to_favorites_without_authentication(): void
    {
        $response = $this->postJson('/api/favorites', [
            'movie' => 'tt0103064'
        ]);

        $response->assertStatus(401);
    }

    public function test_can_add_movie_to_favorites(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/favorites', [
            'movie' => 'tt0103064'
        ]);

        $response->assertNoContent();
    }

    public function test_cannot_add_not_existing_movie_to_favorites(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/favorites', [
            'movie' => 'not_found_movie'
        ]);

        $response->assertBadRequest();
    }

    public function test_can_delete_movie_from_favorites(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->delete('/api/favorites/tt0103064');

        $response->assertNoContent();
    }
}
