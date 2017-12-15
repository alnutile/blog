<?php
namespace Tests\Unit;

use BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\File;

/**
 * Class FileHelperTest
 * @package Tests\Unit
 *
 * @coversDefaultClass \App\FileHelper
 */
class FileHelperTest extends BrowserKitTestCase
{


    use \App\FileHelper;

    /**
     * @covers ::convertToJpg
     * @covers ::handleFile
     * @covers ::saveAndConvertFile
     */
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

    public function testOriginalName()
    {

        $root = "/tmp/foo.jpg";

        $results = $this->convertToJpg($root, "foo.jpg");

        $this->assertEquals('foo.jpg', $results['name']);
    }
}
