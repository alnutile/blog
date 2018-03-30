<?php

namespace App\Search\Fragments;

class StemAnalyzedTextFragment extends AbstractStaticFragment
{

    /**
     * @var array
     */
    protected $fragment = [
        'type' => 'text',
        'analyzer' => 'stem',
    ];
}
