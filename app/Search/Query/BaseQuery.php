<?php
namespace App\Search\Query;

use ElasticSearcher\Abstracts\AbstractQuery;



abstract class BaseQuery extends AbstractQuery
{
    protected $request = [];

    protected $size = 20;

    public function getQuery()
    {
        return array_get($this->request, 'q', null);
    }

    public function getNextFrom()
    {
        if ($this->getPageFromRequest() === 1) {
            return 0;
        }

        return (($this->getPageFromRequest() - 1) * $this->size) - 1;
    }

    public function getPageFromRequest()
    {
        return array_get($this->request, 'page', 1);
    }

    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }


}