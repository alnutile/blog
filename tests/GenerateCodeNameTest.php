<?php
use Illuminate\Support\Facades\File;
use App\GenerateCodeName;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;

class GenerateCodeNameTest extends TestCase
{

    /**
     *
     */
    public function testConnectToApi()
    {
        $this->markTestSkipped("@Al just playing with api");
        $config = [];
        $config['base_uri'] = "https://api.themoviedb.org";

        $client = new \GuzzleHttp\Client($config);
        //https://api.themoviedb.org/3/discover/movie?sort_by=popularity.asc&api_key=7dafe913e6430ca5d24b96cf96dbceb1
        $results = $client->request(
            "GET",
            "/3/discover/movie",
            [
                'query' => [
                    'sort_by' => 'popularity.asc',
                    "api_key" => config('services.movie_db.key')
                ]
            ]
        );
        File::put(
            __DIR__ . "/fixtures/movie_results.json",
            $results->getBody()
        );

    }

    public function testNameStandardization()
    {
        //spaces to hyphen
        //all lower case
        //no non alpha characters

        $name = "Nippon Judan: Higashi Nihon Hen's";
        $mock = new MockHandler([
            new Response(200, [$name])
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        $code_name = new GenerateCodeName($client);
        $results = $code_name->standardizeName($name);
        $this->assertEquals("nippon-judan-higashi-nihon-hens", $results);

    }

}