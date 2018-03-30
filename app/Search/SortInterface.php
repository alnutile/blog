<?php

namespace App\Search;

interface SortInterface
{

    /**
     * The ID of the sort. This is used as the identifier in the query string too.
     *
     * @return string
     */
    public function id();

    /**
     * The search document key/path. E.g. data.created_at
     *
     * @return string
     */
    public function searchKey();

    /**
     * The default search direction. either 'asc' or 'desc'.
     *
     * @return string
     */
    public function defaultDirection();
}
