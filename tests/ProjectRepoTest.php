<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectRepoTest extends TestCase
{

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
