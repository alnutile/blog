<?php

namespace App\Search\Fragments;

use ElasticSearcher\Abstracts\AbstractFragment;

/**
 * Extend this if you have fragments that can be defined as a static array.
 *
 * Classes implementing this just need to define a protected $fragment property.
 */
abstract class AbstractStaticFragment extends AbstractFragment
{
    /**
     * @var array
     */
    protected $fragment;

    /**
     * StaticAbstractFragment constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        if (!isset($this->fragment)) {
            throw new \Exception('No fragment set for %s class', get_class($this));
        }

        $this->setBody($this->fragment);
    }
}
