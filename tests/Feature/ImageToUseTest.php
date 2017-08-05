<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImageToUseTest extends BrowserKitTestCase
{


    public function testGettingAWSPath()
    {
        $image = new \App\ImageToUse();

        $results = $image->exists("1.jpg");

        $this->assertEquals("/img/foo.png", $results);
    }

    public function testSeeingIfExistOnAWS()
    {
        $image = new \App\ImageToUse();

        $results = $image->exists("foo.png");

        $this->assertEquals("/img/foo.png", $results);
    }
}
