<?php

namespace App\Search\Fragments;

class TextAndKeywordMappingFragment extends AbstractStaticFragment
{
    /**
     * @var array
     */
    protected $fragment = [
        'type' => 'text',
        'fields' => [
            'keyword' => ['type' => 'keyword'],
        ],
    ];
}
