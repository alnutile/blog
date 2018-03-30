<?php

namespace App\Jobs\Search;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class SearchJobBase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $index = 'default';

    /**
     * @return array
     */
    protected function generateBaseParameters($id, $type = 'post')
    {
        return [
            'index' => $this->index,
            'type' => $type,
            'id' => $id,
        ];
    }
}
