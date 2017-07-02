<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 6/2/14
 * Time: 7:00 PM
 */

namespace App\Search;

use App\Repositories\SearchRepository;

class Search implements SearchInterface
{

    protected $repo;

    public function __construct(SearchRepository $repo)
    {
        $this->repo = $repo;
    }

    public function find()
    {
        $args = func_get_args();
        if (count($args)) {
            list($query) = $args;
            return $this->repo->find($query);
        } else {
            return $this->repo->findAll();
        }
    }
}
