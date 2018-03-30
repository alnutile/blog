<?php

namespace App\Search\Fragments;

class PorterStemAnalyzerFragment extends AbstractStaticFragment
{
    protected $fragment = [
        'tokenizer' => 'standard',
        'filter' => ['standard', 'lowercase', 'stop', 'porter_stem'],
    ];
}
