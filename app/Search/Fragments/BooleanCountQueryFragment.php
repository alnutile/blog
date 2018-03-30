<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

class BooleanCountQueryFragment extends AbstractFragment
{

    /**
     * DateRangeFragment constructor.
     *
     * @param string $key
     * @param bool $value
     */
    public function __construct($key, $value)
    {
        // If it's true, make it a range query - everything over 0.
        if ($value) {
            $fragment = [
                'range' => [
                    $key => [
                        'gt' => 0,
                    ],
                ],
            ];
        // If it's false, get everything that matches 0.
        } else {
            $fragment = [
                'term' => [
                    $key => 0,
                ],
            ];
        }

        $this->setBody($fragment);
    }
}
