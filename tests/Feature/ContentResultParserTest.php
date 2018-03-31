<?php

namespace Tests\Feature;

use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Search\Results\ContentResultParser;

class ContentResultParserTest extends TestCase
{


    public function testGettingPaginatedResults()
    {
        $data = \File::get(base_path("tests/fixtures/es_search_response.json"));
        $data = json_decode($data, true);

        $parser = new ContentResultParser();
        $parser->setRawResults($data);
        $parser->getPaginated();

    }
}
