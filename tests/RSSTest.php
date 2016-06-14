<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RSSTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @test
     */
    public function rss_should_work()
    {
        $post = \App\Post::first();
        
        $this->visit('/rss')->see($post->title);

        $this->assertResponseOk();

        
    }
}
