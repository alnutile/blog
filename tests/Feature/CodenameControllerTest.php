<?php
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\RequestException;
use function GuzzleHttp\json_encode;


class CodenameControllerTest extends TestCase
{

    public function testPostAndGetCodename()
    {
        $name = "Drone Wars";
        $data = [];
        foreach (range(1, 20) as $item) {
            $data[] = ['title' => $name];
        }
        $mock = new MockHandler([
            new Response(200, [], json_encode([
                'results' => $data
            ]))
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);
        \App::instance(\GuzzleHttp\Client::class, $client);
        $results = $this->json("POST", 'codenames', [])->assertStatus(200);
        $this->assertNotNull($results);
        $this->assertEquals("drone-wars", $results->getContent());
    }
}
