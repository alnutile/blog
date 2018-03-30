<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

/**
 * Class SortFragment
 * @package App\Search\Fragment
 */
class SortFragment extends AbstractFragment
{

    /**
     * SortFragment constructor.
     *
     * @param string $key
     * @param string $direction
     */
    public function __construct($key, $direction = 'asc')
    {
        $fragment = [
            // The key is the data attribute. Can contain '.' syntax etc..
            $key => [
                'order' => $direction,
            ],
        ];

        $this->setBody($fragment);
    }
}
