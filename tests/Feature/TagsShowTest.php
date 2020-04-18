<?php

namespace Tests\Feature;

use BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use TestCase;

/**
 * @coversDefaultClass \App\Http\Controllers\TagsController
 */
class TagsShowTest extends BrowserKitTestCase
{

    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->withoutJobs();
    }


    /**
     * A basic test example.
     *
     * @return void
     *
     * @covers ::show
     * @covers ::iterateOverPosts
     * @covers ::iterateOverProjects
     * @covers ::iterateOverTags
     */
    public function testShowpage()
    {
        $tag = factory(\App\Tag::class)->create();
        $tag2 = factory(\App\Tag::class)->create();
        $tag3 = factory(\App\Tag::class)->create();

        $post = factory(\App\Post::class)->create();

        $post->tags()->attach($tag->id);
        $post->tags()->attach($tag2->id);
        $post->tags()->attach($tag3->id);

        $this->visit('/tags/' . $tag->id)
            ->assertResponseOk();
    }
}
