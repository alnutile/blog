<?php
namespace App\Search\Results;


class ContentResultParser extends BaseResultParser
{

    public function getResults()
    {
        return $this->getHits();
    }



}