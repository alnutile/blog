<?php

namespace Tests\Feature;

use Facades\App\Search\Query\ContentQuery;
use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Facades\Elasticsearch\Client;

class ElasticSearchControllerTest extends TestCase
{


    public function testGetPaginatedResults()
    {
        $data = \File::get(base_path("tests/fixtures/results_search.json"));
        $data = json_decode($data, 128);

        ContentQuery::shouldReceive("setRequest")->once()->andReturnSelf();
        ContentQuery::shouldReceive("run")->once()->andReturnSelf();
        ContentQuery::shouldReceive("getPaginated")->once()->andReturn($data);


        $results = $this->json("GET", "/api/search", ['page' => 1, 'q' => "Laravel"])
            ->assertStatus(200);

        $results = json_decode($results->getContent(), true);
        $this->assertArrayHasKey('total', $results);
        $this->assertEquals(84, $results['total']);
        $this->assertArrayHasKey('current_page', $results);
        $this->assertEquals(1, $results['current_page']);
        $this->assertArrayHasKey('from', $results);
        $this->assertEquals(1, $results['from']);
        $this->assertArrayHasKey('to', $results);
        $this->assertEquals(20, $results['to']);
        $this->assertArrayHasKey('max_score', $results);
    }

    public function testGetNonPaginatedResultsPageOne()
    {

        $data = \File::get(base_path("tests/fixtures/results_search.json"));
        $data = json_decode($data, 128);

        ContentQuery::shouldReceive("setRequest")->once()->andReturnSelf();
        ContentQuery::shouldReceive("run")->once()->andReturnSelf();
        ContentQuery::shouldReceive("getPaginated")->once()->andReturn($data);

        $results = $this->json("GET", "/api/search", ['q' => "Laravel"])
            ->assertStatus(200);
        $results = json_decode($results->getContent(), true);
        $this->assertArrayHasKey('total', $results);
        $this->assertEquals(84, $results['total']);
        $this->assertArrayHasKey('current_page', $results);
        $this->assertEquals(1, $results['current_page']);
        $this->assertArrayHasKey('from', $results);
        $this->assertEquals(1, $results['from']);
        $this->assertArrayHasKey('to', $results);
        $this->assertEquals(20, $results['to']);
        $this->assertArrayHasKey('max_score', $results);

        $this->assertArrayHasKey('data', $results);
        $this->assertEquals(20, count($results['data']));
    }
}
