<?php

/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 6/2/14
 * Time: 7:16 PM
 */

namespace App\Repositories;

use App\Project;
use App\Post;

class SearchRepository implements AlsRepositoryInterface
{

    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function find($args)
    {
        $results = $this->post->where('title', 'LIKE', "%$args%")->get();
        return $results;
    }

    public function findAll()
    {
        $results = $this->post->all()->get();
        return $results;
    }
}
