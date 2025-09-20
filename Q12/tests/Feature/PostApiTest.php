<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Post;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_list_active_posts()
    {
        Post::factory()->create(['title' => 'Active Post', 'is_active' => 1]);
        Post::factory()->create(['title' => 'Inactive Post', 'is_active' => 0]);

        $response = $this->getJson('/api/posts');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Active Post'])
                 ->assertJsonFragment(['title' => 'Inactive Post']);
    }

    /** @test */
    public function it_can_create_a_post()
    {
        $data = [
            'title' => 'My New Post',
            'image' => 'https://example.com/test.jpg',
            'content' => 'This is a new post.'
        ];

        $response = $this->postJson('/api/posts', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'My New Post']);
                 
        $this->assertDatabaseHas('posts', ['title' => 'My New Post']);
    }

    /** @test */
    public function it_can_update_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->putJson("/api/posts/{$post->id}", [
            'title' => 'Updated Title'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Updated Title']);

        $this->assertDatabaseHas('posts', ['title' => 'Updated Title']);
    }

    /** @test */
    public function it_can_delete_a_post()
    {
        $post = Post::factory()->create();

        $response = $this->deleteJson("/api/posts/{$post->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    /** @test */
    public function it_can_set_post_active_and_inactive()
    {
        $post = Post::factory()->create(['is_active' => 0]);

        $this->patchJson("/api/posts/{$post->id}/activate")
             ->assertStatus(200)
             ->assertJsonFragment(['is_active' => 1]);

        $this->patchJson("/api/posts/{$post->id}/deactivate")
             ->assertStatus(200)
             ->assertJsonFragment(['is_active' => 0]);
    }

    /** @test */
    public function it_can_set_ordering()
    {
        $post = Post::factory()->create();

        $this->patchJson("/api/posts/{$post->id}/order", ['order_no' => 5])
             ->assertStatus(200)
             ->assertJsonFragment(['order_no' => 5]);

        $this->assertDatabaseHas('posts', ['id' => $post->id, 'order_no' => 5]);
    }

    /** @test */
    public function it_can_search_posts()
    {
        Post::factory()->create(['title' => 'Laravel Rocks']);
        Post::factory()->create(['title' => 'PHP Tips']);

        $response = $this->getJson('/api/posts?search=Laravel');

        $response->assertStatus(200)
                 ->assertJsonFragment(['title' => 'Laravel Rocks'])
                 ->assertJsonMissing(['title' => 'PHP Tips']);
    }
}
