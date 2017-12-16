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

        $results = $this->json("POST", "j2a", [
            'data' => $json
        ])->assertStatus(200);

        $this->assertNotNull($results);

    }

    public function testDealWithBadJson()
    {

    }
}
