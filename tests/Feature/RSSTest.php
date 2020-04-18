<?php

namespace Tests\Feature;

use BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RSSTest extends BrowserKitTestCase
{
    use DatabaseTransactions, DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->withoutJobs();
    }


    /**
     * @test
     */
    public function rss_should_work()
    {

        factory(\App\Post::class, 5)->create();

        $post = \App\Post::first();

        $this->visit('/rss')->see($post->title);

        $this->assertResponseOk();
    }
}
