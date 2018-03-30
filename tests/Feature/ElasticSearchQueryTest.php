<?php

namespace Tests\Feature;

use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Facades\Elasticsearch\ClientBuilder;

class ElasticSearchQueryTest extends TestCase
{

    public function testGettingResults()
    {
        //$client = ClientBuilder::create()->build();

        //$client = ClientBuilder::class;

        $params = [
            'index' => 'default',
            'type' => 'post',
            'body' => [
                'query' => [
                    'match' => [
                        'body' => 'Laravel'
                    ]
                ]
            ]
        ];

        $response = ClientBuilder::search($params);

        \File::put(base_path("tests/fixtures/es_search_response.json"), json_encode($response, 128));
        dd($response);

    }
}
