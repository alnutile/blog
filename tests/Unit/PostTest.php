<?php

namespace Tests\Unit;

use App\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Log;

/**
 * Class PostTest
 * @package Tests\Unit
 * @coversDefaultClass \App\Post
 */
class PostTest extends \TestCase
{
    use DatabaseTransactions, DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @covers ::search
     */
    public function testSearch()
    {
        factory(\App\Post::class, 3)->create(['title' => "Yo"]);
        factory(\App\Post::class)->create(['title' => 'Test Not Active', 'active' => 0]);
        factory(\App\Post::class)->create(['title' => 'Test Yup', 'active' => 1]);
        $posts = (new Post())->search("Test");
        $this->assertCount(1, $posts->toArray());

    }
}
