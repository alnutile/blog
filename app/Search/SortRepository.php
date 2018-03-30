<?php

namespace App\Search;

use Illuminate\Support\Collection;

class SortRepository
{

    /**
     * @var \App\Search\SortInterface[]
     */
    protected $sorts = [];

    /**
     * SortRepository constructor.
     */
    public function __construct()
    {
        $score = new ArraySort('score', '_score');
        $this->register($score);
    }

    /**
     * Register a sort.
     *
     * @param \App\Search\SortInterface $sort
     *
     * @return $this
     */
    public function register(SortInterface $sort)
    {
        $this->sorts[$sort->id()] = $sort;
        return $this;
    }

    /**
     * Register multiple sorts.
     *
     * @param \App\Search\SortInterface[] $sorts
     *
     * @return $this
     */
    public function registerMultiple(array $sorts)
    {
        foreach ($sorts as $sort) {
            $this->register($sort);
        }

        return $this;
    }

    /**
     * Get a specific sort.
     *
     * @param string $id
     *
     * @return null|\App\Search\SortInterface
     */
    public function get($id)
    {
        return $this->has($id) ? $this->sorts[$id] : null;
    }

    /**
     * Determines if a sort exists.
     *
     * @param string $id
     *
     * @return bool
     */
    public function has($id)
    {
        return isset($this->sorts[$id]);
    }

    /**
     * Returns all sort keys.
     *
     * @return string[]
     */
    public function keys()
    {
        return array_keys($this->sorts);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return new Collection($this->sorts);
    }
}
