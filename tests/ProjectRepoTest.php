<?php

use App\Post;
use App\Project;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class ProjectRepoTest extends BrowserKitTestCase
{

    use DatabaseMigrations, WithoutMiddleware;

    public function testRefactorOutTagsToRepo()
    {
        $user = factory(\App\User::class)->create();
        $this->be($user);
        $path = base_path('tests/fixtures/foo.png');

        $faker = Faker\Factory::create();
        $title = $faker->word;

        $this->visit("/projects/create")
            ->type($title, 'title')
            ->type('baz, boo', 'tags')
            ->type('lorem ipsum', 'body')
            ->check('active')
            ->attach($path, 'photo_file_name')
            ->press("Create Project");

        $project = Project::with('tags')->where("title", $title)->first();

        $this->assertNotNull($project);

        $this->assertNotNull($project->tags);

        $this->assertCount(2, $project->tags);
    }

    public function testRefactorOutFilesToRepo()
    {
        $user = factory(\App\User::class)->create();
        $this->be($user);
        $path = base_path('tests/fixtures/foo.png');

        $faker = Faker\Factory::create();
        $title = $faker->word;

        $this->visit("/projects/create")
            ->type($title, 'title')
            ->type('baz, boo', 'tags')
            ->type('lorem ipsum', 'body')
            ->check('active')
            ->attach($path, 'photo_file_name')
            ->press("Create Project");

        $project = Project::with('tags')->where("title", $title)->first();

        $this->assertNotNull($project);

        $this->assertEquals("foo.jpg", $project->photo_file_name);

        $this->assertFileExists(storage_path('/app/foo.jpg'));
    }
}
