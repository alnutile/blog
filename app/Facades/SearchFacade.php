<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 5/16/14
 * Time: 1:28 PM
 */

namespace App\Facades;

use App\Repositories\SearchRepository;
use Illuminate\Support\Facades\Facade;

class SearchFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'SearchAls';
    }
}
