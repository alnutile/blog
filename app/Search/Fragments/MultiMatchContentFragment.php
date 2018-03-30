<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

class MultiMatchContentFragment extends AbstractFragment
{
    /**
     * MultiMatchContentFragment constructor.
     *
     * @param string $query
     *   The search query.
     * @param string[] $fields
     *   The fields to search on. These can contain '.' nesting and additional
     *   weighting overrides as suffixes, for example. Things like 'data.label^2'.
     * @param string $type
     *   The multi match query type.
     * @param int $boost
     */
    public function __construct($query, array $fields, $type = 'best_fields', int $boost = 0)
    {
        $fragment = [
            'multi_match' => [
                'query' => $query,
                'type' => $type,
                'fields' => $fields,
            ]
        ];

        if ($boost) {
            $fragment['multi_match']['boost'] = $boost;
        }

        $this->setBody($fragment);
    }
}
