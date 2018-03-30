<?php

namespace Tests\Feature;

use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ElasticSearchControllerTest extends TestCase
{


    public function testGetNonPaginatedResults()
    {
        $results = $this->json("GET", "/api/search", ['q' => "Laravel"])
            ->assertStatus(200);

        $results = json_decode($results->getContent(), true);

        dd($results['hits']);
        $this->assertArrayHasKey('hits', $results);
        $this->assertArrayHasKey('total', $results);
        $this->assertArrayHasKey('max_score', $results);
        $this->assertCount(84, $results['hits']['hits']);
    }
}
