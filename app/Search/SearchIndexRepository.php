<?php

namespace App\Search;

use ElasticSearcher\Abstracts\AbstractIndex;

class SearchIndexRepository implements SearchIndexRepositoryInterface
{
    /**
     * @var \ElasticSearcher\Abstracts\AbstractIndex[]
     */
    protected $indexes = [];

    /**
     * @param \ElasticSearcher\Abstracts\AbstractIndex $index
     * @return $this
     */
    public function register(AbstractIndex $index)
    {
        $this->indexes[$index->getName()] = $index;

        return $this;
    }

    /**
     * @return \ElasticSearcher\Abstracts\AbstractIndex[]
     */
    public function all()
    {
        return $this->indexes;
    }
}
