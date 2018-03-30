<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

class AggregationsFragment extends AbstractFragment
{
    /**
     * AggregationsFragment constructor.
     */
    public function __construct($aggregations_size)
    {
        $fragment = [
            'type_prefix' => [
                'terms' => [
                    'field' => 'type.prefix',
                    'size' => $aggregations_size,
                ],
            ],
            'type_suffix' => [
                'terms' => [
                    'field' => 'type.suffix',
                    'size' => $aggregations_size,
                ],
            ],
            'application_id' => [
                'terms' => [
                    'field' => 'application_id.keyword',
                    'size' => $aggregations_size,
                ],
            ],
            'language' => [
                'terms' => [
                    'field' => 'language',
                    'size' => $aggregations_size,
                ],
            ],
        ];

        $this->setBody($fragment);
    }
}
