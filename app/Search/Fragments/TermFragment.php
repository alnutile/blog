<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

class TermFragment extends AbstractFragment
{
    /**
     * TermsFragment constructor.
     *
     * @param string $key
     * @param string $value
     */
    public function __construct($key, $value)
    {
        $fragment = [
            'term' => [
                $key => $value,
            ],
        ];

        $this->setBody($fragment);
    }
}
