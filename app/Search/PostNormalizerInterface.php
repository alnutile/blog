<?php

namespace App\Search;

use App\Post;

interface PostNormalizerInterface
{

    /**
     * @param \App\Post $post
     *
     * @return array
     */
    public function normalize(Post $post);
}
