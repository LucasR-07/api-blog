<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    const baseURL = 'posts';

    public function testIndex()
    {
        $response = $this->json('GET', self::baseURL);

        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
                'data' =>
                [
                    '*' => [
                        'title',
                        'content',
                        'slug'
                    ]
                ]
            ]
        );
    }

    public function testShow()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->create(['user_id' => $user->id]);

        $response = $this->json(
            'GET',
            self::baseURL . '/' . $post->id
        );
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'title',
            'content',
            'slug',
        ]);
    }
}
