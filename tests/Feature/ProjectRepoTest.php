<?php

namespace Tests\Feature;

use App\Post;
use App\Project;
use App\ProjectRepo;
use BrowserKitTestCase;
use Facades\App\Search\Query\ContentQuery;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use TestCase;

/**
 * Class ProjectRepoTest
 * @package Tests\Feature
 *
 * @coversDefaultClass \App\ProjectRepo
 */
class ProjectRepoTest extends BrowserKitTestCase
{

    use DatabaseMigrations, DatabaseTransactions, WithoutMiddleware;

    public function setUp()
    {
        parent::setUp();
        $this->withoutJobs();
    }

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

    public function testDataTags()
    {
        $data['tags'] = false;
        $project_repo = new ProjectRepo();
        $project_repo->setDataTags($data);
        $this->assertEquals(0, $data['tags']);
    }

    /**
     * @covers ::setDefaultFileName
     */
    public function testDefaultFileName()
    {
        $project = factory(\App\Project::class)->create(
            ['photo_file_name' => "foo.png"]
        );
        $project_repo = new ProjectRepo();
        $data = [];
        $results = $project_repo->setDefaultFileName($project, $data);
        $this->assertEquals('foo.png', $results['photo_file_name']);
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
