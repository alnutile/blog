<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades\Elasticsearch\ClientBuilder;

class ElasticSearchController extends Controller
{


    public function search(Request $request)
    {
        try {

            /**
             * Will move a lot of this out after
             */
            $params = [
                'index' => 'default',
                'type' => 'post',
                'body' => [
                    'query' => [
                        'match' => [
                            'body' => $request->q
                        ]
                    ]
                ]
            ];

            $results = ClientBuilder::search($params);

            $results = array_get($results, 'hits', []);

            return response()->json($results, 200);

        } catch (\Exception $e) {
            \Log::error($e);
            return response()->json(null, 422);
        }
    }
}
