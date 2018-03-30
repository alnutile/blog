<?php

namespace App\Search;

use Illuminate\Support\Collection;

class FilterRepository
{
    /**
     * @var \Pfizer\CanvasEnrichmentSystem\Search\FilterInterface[]
     */
    protected $filters = [];

    /**
     * FilterRepository constructor.
     */
    public function __construct()
    {
        $query = new QueryFilter();
        $this->register($query);
    }

    /**
     * Register a filter.
     *
     * @param \Pfizer\CanvasEnrichmentSystem\Search\FilterInterface $filter
     *
     * @return $this
     */
    public function register(FilterInterface $filter)
    {
        $this->filters[$filter->id()] = $filter;

        return $this;
    }

    /**
     * Register multiple filters.
     *
     * @param \Pfizer\CanvasEnrichmentSystem\Search\FilterInterface[] $filters
     *
     * @return $this
     */
    public function registerMultiple(array $filters)
    {
        foreach ($filters as $filter) {
            $this->register($filter);
        }

        return $this;
    }

    /**
     * Get a specific filter.
     *
     * @param string $id
     * @return null|\Pfizer\CanvasEnrichmentSystem\Search\FilterInterface
     */
    public function get($id)
    {
        return $this->has($id) ? $this->filters[$id] : null;
    }

    /**
     * Determines is a filter exists.
     *
     * @param string $id
     * @return bool
     */
    public function has($id)
    {
        return isset($this->filters[$id]);
    }

    /**
     * Returns all filter keys.
     *
     * @return string[]
     */
    public function keys()
    {
        return array_keys($this->filters);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function all()
    {
        return new Collection($this->filters);
    }

    /**
     * Filter an array of parameters by allowed filters and valid values.
     *
     * @param array $filter_query
     *
     * @return array
     */
    public function filter(array $filter_query)
    {
        return collect($filter_query)->filter(function ($value, $id) {
            return $this->has($id) && $this->get($id)->validate($value);
        })->all();
    }

    /**
     * Parses and filters a query string, returning an array of valid filters.
     *
     * @param string $query_string
     *
     * @return array
     */
    public function parseAndFilterQueryString($query_string)
    {
        parse_str(ltrim($query_string, '?'), $parsed_data);

        return $this->filter($parsed_data);
    }
}
