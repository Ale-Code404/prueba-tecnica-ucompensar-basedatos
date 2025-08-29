<?php

namespace Tests\Feature\Movies;

use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class GetMovieDetailsTest extends TestCase
{
    public function test_cannot_get_movie_details_without_authentication(): void
    {
        $response = $this->getJson('/api/movies/1');

        $response->assertStatus(401);
    }

    public function test_can_get_movie_details_with_authentication(): void
    {
        $user = \App\Models\User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/movies/tt0103064');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' =>
            [
                'id',
                'title',
                'description',
                'year',
                'directors',
                'writers',
                'actors',
                'genres',
            ]
        ]);
    }
}
