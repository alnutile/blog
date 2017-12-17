<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use function GuzzleHttp\json_encode;

class ArrayJsonConverterTest extends TestCase
{

    public function testStringArrayToJson()
    {
        $string = <<<EOD
    [
        "foo" => "bar",
        "baz" => [
            1,2,3
        ]
]
EOD;
        dd((array)$string);
    }

    public function testConvertToArrayToJson()
    {
        $array = [
            'foo' => 'bar',
            'baz' => ['foobar' => [1, 2, 3]]
        ];

        $results = $this->json("POST", "a2j", [
            'data' => json_encode($array)
        ])->assertStatus(200);

        $this->assertNotNull($results);
        $this->assertEquals('"{\"foo\":\"bar\",\"baz\":{\"foobar\":[1,2,3]}}"', $results->getContent());

    }

    public function testConvertToJsonToArray()
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
