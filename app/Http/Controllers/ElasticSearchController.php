<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\Elasticsearch\Client;
use App\Search\Results\ContentResultParser;
use App\Search\Query\ContentQuery;


class ElasticSearchController extends Controller
{


    public function search(Request $request)
    {
        try {

            /** @var ContentQuery $query */
            $query = \App::make(ContentQuery::class);

            /** @var ContentResultParser $results */
            $results = $query->setRequest($request->all())->run();

            return response()->json($results->getPaginated(), 200);
        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(null, 422);
        }
    }
}
