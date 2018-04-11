<?php

namespace Tests\Feature;

use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Search\Query\ContentQuery;
use ElasticSearcher\ElasticSearcher;

class ContentQueryTest extends TestCase
{

    public function testPageBreaks()
    {
        $request = ['page' => 3, 'q' => "Laravel"];
        $searcher = \App::make(ElasticSearcher::class);
        $query = new ContentQuery($searcher);
        $query->setRequest($request);
        $this->assertEquals($query->getNextFrom(), 39);

        $query->setup();

        $this->assertEquals(20, $query->getBody()['size']);
        $this->assertEquals(39, $query->getBody()['from']);

        $request = ['page' => 2];
        $searcher = \App::make(ElasticSearcher::class);
        $query = new ContentQuery($searcher);
        $query->setRequest($request);
        $this->assertEquals($query->getNextFrom(), 19);

        $request = ['page' => 1];
        $searcher = \App::make(ElasticSearcher::class);
        $query = new ContentQuery($searcher);
        $query->setRequest($request);
        $this->assertEquals($query->getNextFrom(), 0);
    }
}
