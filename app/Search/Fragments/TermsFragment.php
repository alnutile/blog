<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

class TermsFragment extends AbstractFragment
{
    /**
     * TermsFragment constructor.
     *
     * @param string $key
     * @param string[] $values
     */
    public function __construct($key, array $values)
    {
        $fragment = [
            'terms' => [
                $key => $values,
            ],
        ];

        $this->setBody($fragment);
    }
}
