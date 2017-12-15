<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArrayJsonConverterTest extends TestCase
{
    public function testConvertToArrayJson()
    {
        $json = \File::get(base_path(
            "tests/fixtures/complex.json"
        ));


    }

    public function testDealWithBadJson()
    {

    }
}
