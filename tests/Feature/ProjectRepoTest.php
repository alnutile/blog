<?php

namespace Tests\Feature;

use App\Post;
use App\Project;
use BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProjectRepoTest
 * @package Tests\Feature
 *
 * @coversDefaultClass \App\ProjectRepo
 */
class ProjectRepoTest extends BrowserKitTestCase
{

    use DatabaseMigrations, DatabaseTransactions, WithoutMiddleware;

    /**
     * @covers ::createProject
     */
    public function testRefactorOutTagsToRepo()
    {
        $user = factory(\App\User::class)->create();
        $this->be($user);
        $path = base_path('tests/fixtures/foo.png');

        $faker = \Faker\Factory::create();
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

        $this->assertEquals("foo.jpg", $project->photo_file_name);
    }

    /**
     * @covers ::handleUpdate
     */
    public function testRefactorOutFilesToRepo()
    {
        $user = factory(\App\User::class)->create();
        $this->be($user);
        $path = base_path('tests/fixtures/foo.png');

        $faker = \Faker\Factory::create();
        $title = "updated title " . $faker->word;

        $project = factory(\App\Project::class)->create();

        $this->visit("/projects/" . $project->id . "/edit")
            ->type($title, 'title')
            ->type('baz, boo, foo', 'tags')
            ->type('lorem ipsum', 'body')
            ->check('active')
            ->attach($path, 'photo_file_name')
            ->press("Update Project");

        $project = Project::with('tags')->where("title", $title)->first();

        $this->assertNotNull($project);

        $this->assertEquals("foo.jpg", $project->photo_file_name);

        $this->assertCount(3, $project->tags);

    }

    public function setUp()
    {
        parent::setUp();
        $this->cleanUp();
    }

    public function tearDown()
    {
        $this->cleanUp();
        parent::tearDown();
    }


    /**
     * @param $files
     */
    public function cleanUp()
    {
        $files = [
            'foo.jpg', 'foo.png'
        ];
        foreach ($files as $file) {
            $path = storage_path('app/' . $file);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }
}
