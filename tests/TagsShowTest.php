<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TagsShowTest extends TestCase
{

    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
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
            ->see($tag2->name)
            ->see($tag3->name)
            ->assertResponseOk();

        //assert can see
    }
}
