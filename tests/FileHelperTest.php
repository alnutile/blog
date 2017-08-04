<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;

class FileHelperTest extends TestCase
{


    use \App\FileHelper;

    public function testMakePngJpg()
    {
        $dest = "/tmp/baz.jpg";

        if (File::exists($dest)) {
            File::delete($dest);
        }

        File::copy(base_path('tests/fixtures/foo.png'), "/tmp/foo.png");

        $root = "/tmp/foo.png";

        $this->convertToJpg($root, "baz.png");

        $this->assertFileExists($dest);
    }
}
