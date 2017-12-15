<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Post::class, 22)->create();

        $posts = \App\Project::all();

        $tags = \App\Tag::all()->get('id');

        foreach ($posts as $post) {
            $post->tags()->attach($tags);
        }
    }
}
