<?php
namespace App\Search\Results;

use ElasticSearcher\Abstracts\AbstractResultParser;

abstract class BaseResultParser extends AbstractResultParser
{

    protected $current_page = 1;
    protected $per_page = 20;

    public function setPerPage($per)
    {
        $this->per_page = $per;
        return $this;
    }

    public function setCurrentPage($page)
    {
        $this->current_page = $page;
        return $this;
    }

    public function getPaginated()
    {

        $paginated = [];
        $paginated['total'] = $this->getTotal();
        $paginated['current_page'] = $this->current_page;
        $paginated['from'] = $this->from();
        $paginated['to'] = $this->to();
        $paginated['hits'] = $this->getHits();
        $paginated['max_score'] = $this->get('hits.max_score');
        $paginated['data'] = collect($this->getHits())->map(function ($item) {
            $data = array_get($item, '_source', []);
            $data['score'] = array_get($item, '_score');
            return $data;
        });

        return $paginated;
    }

    protected function from()
    {
        if ($this->current_page === 1) {
            return 1;
        }
        return (($this->current_page - 1) * $this->per_page) + 1;
    }

    protected function to()
    {
        return ($this->from() + $this->per_page) - 1;
    }
}