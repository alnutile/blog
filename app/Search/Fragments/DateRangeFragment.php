<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

class DateRangeFragment extends AbstractFragment
{

    /**
     * DateRangeFragment constructor.
     *
     * @param string $key
     * @param string $start
     * @param string $end
     * @param string $format
     */
    public function __construct($key, $start, $end, $format = 'Y-m-d')
    {
        $fragment = [
            'range' => [
                $key => [
                    'gte' => $start,
                    'lte' => $end,
                    'format' => $format
                ],
            ],
        ];

        $this->setBody($fragment);
    }
}
