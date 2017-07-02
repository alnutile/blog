<?php

use App\Post;
use App\Project;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;

class ProjectRepoTest extends TestCase
{

    use DatabaseMigrations, WithoutMiddleware;

    public function testRefactorToRepo() {
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

    public function testSaveFileLocally()
    {
        $localFile = base_path('/tests/fixtures/foo.png');

        $sym = new \Symfony\Component\HttpFoundation\File\UploadedFile($localFile, 'foo.png', null, null, null, true);

        $uploadfile = \Illuminate\Http\UploadedFile::createFromBase($sym);

        // array $query = array(), array $request = array(),
        // array $attributes = array(), array $cookies = array(),
        // array $files = array(), array $server = array(), $content = null
        $request = new \Illuminate\Http\Request([], [], [], [], [$uploadfile], [], null);


        //dd(sprintf("Has file %s", $request->hasFile('photo_file_name')));
    }
}
