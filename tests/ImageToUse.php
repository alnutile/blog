<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ImageToUse extends TestCase
{

    public function testSeeingIfExistOnAWS()
    {
        $image = new \App\ImageToUse();

        $results = $image->exists("foo.png");

        $this->assertEquals("/img/foo.png", $results);

    }
}
