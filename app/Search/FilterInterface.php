<?php

namespace App\Search;

interface FilterInterface
{

    /**
     * The filter ID. This is used to retrieve but also in query string parameters.
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
     * The filter type. Currently support 'default', 'text', 'date'.
     *
     * @return string
     */
    public function type();

    /**
     * Return an array of filter options.
     *
     * The key should be the identifier, the value the label.
     *
     * @return array
     */
    public function options();

    /**
     * The filter value of the default option.
     *
     * @return string
     */
    public function default();

    /**
     * Validates a filter option.
     *
     * @param mixed $value
     *
     * @return bool
     */
    public function validate($value);

    /**
     * Processes the submitted value. Converting it to the needed format.
     *
     * @param string $value
     *
     * @return mixed
     */
    public function processSubmittedValue($value);
}
