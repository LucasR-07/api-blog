<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    const baseURL = '/posts';

    public function testIndex()
    {
        $response = $this->get('posts');

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
}
