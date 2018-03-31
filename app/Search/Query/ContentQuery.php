<?php
namespace App\Search\Query;

use App\Search\Results\ContentResultParser;



class ContentQuery extends BaseQuery
{


    public function setup()
    {
        $this->searchIn('default', 'content');

        $body = [
            'from' => $this->getNextFrom(),
            'size' => $this->size,
            'query' => [
                'match' => [
                    //body or title
                    'body' => $this->getQuery()
                ]
            ]
        ];

        $this->setBody($body);

        $this->parseResultsWith(
            (new ContentResultParser())
                ->setPerPage($this->size)
                ->setCurrentPage($this->getPageFromRequest())
        );
    }



}