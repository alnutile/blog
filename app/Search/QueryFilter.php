<?php

namespace App\Search;

/**
 * Search query 'q' specific filter.
 */
class QueryFilter extends AbstractStaticFilter
{

    /**
     * @var string
     */
    protected $id = 'q';

    /**
     * @var string
     */
    protected $type = 'text';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $default = '';

    /**
     * {@inheritdoc}
     */
    public function validate($value)
    {
        return !empty($value);
    }
}
