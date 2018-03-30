<?php

namespace App\Search;

use ElasticSearcher\Abstracts\AbstractIndex;

interface SearchIndexRepositoryInterface
{
    /**
     * @param \ElasticSearcher\Abstracts\AbstractIndex $index
     * @return $this
     */
    public function register(AbstractIndex $index);

    /**
     * @return \ElasticSearcher\Abstracts\AbstractIndex[]
     */
    public function all();
}
