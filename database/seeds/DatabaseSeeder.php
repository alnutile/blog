<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);

        factory(\App\Tag::class, 5)->create();

        factory(\App\Project::class, 5)->create();

        $projects = \App\Project::all();

        $tags = \App\Tag::all()->get('id');
        foreach($projects as $project) {
            $project->tags()->attach($tags);
        }

        factory(\App\Post::class, 5)->create();

        $posts = \App\Project::all();
        foreach($posts as $post) {
            $post->tags()->attach($tags);
        }
    }
}
