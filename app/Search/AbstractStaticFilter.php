<?php

namespace App\Search;

abstract class AbstractStaticFilter implements FilterInterface
{

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $searchKey;

    /**
     * @var string
     */
    protected $type = 'default';

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var string
     */
    protected $default;

    /**
     * {@inheritdoc}
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function searchKey()
    {
        return $this->searchKey ? : $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function type()
    {
        return $this->type;
    }

    /**
     * {@inheritdoc}
     */
    public function options()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function default()
    {
        return $this->default;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($value)
    {
        return isset($this->options()[$value]);
    }

    /**
     * {@inheritdoc}
     */
    public function processSubmittedValue($value)
    {
        return $value;
    }
}
