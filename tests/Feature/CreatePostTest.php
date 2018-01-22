<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreatePostTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePostTest()
    {
        $post = factory(Post::class)->make();
    
    $this->post('/api/posts', [
      'name' => $post->name,
      'topic' => $post->topic,
      ])->seeApiSuccess()
      ->seeJsonObject('post')
      ->seeJson([
        'name' => $post->name,
        'topic' => $post->topic,
      ]);
    
    $this->seeInDatabase('posts', [
      'name' => $post->name,
      'topic' => $post->topic,
      ]);

    }
}
