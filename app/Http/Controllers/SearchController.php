<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 6/2/14
 * Time: 7:05 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SearchController extends BaseController
{
    public function search(Request $request)
    {
        $args = $request->input('search');

        $results = \SearchAls::find($args);

        return Response::json($results->toArray(), 200);
    }
}
