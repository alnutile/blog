<?php

namespace App\Jobs\Search;

use App\Post;
use App\Search\HitNormalizerInterface;
use Elasticsearch\Client;
use Illuminate\Log\Writer;
use App\Search\PostNormalizerInterface;
use Elasticsearch\ClientBuilder;
use App\Project;
use App\Search\ProjectNormalizerInterface;

class IndexProjectJob extends SearchJobBase
{
    /**
     * @var \App\Project
     */
    protected $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @param \Elasticsearch\Client $client
     * @param \App\Search\ProjectNormalizerInterface $normallizer
     * @param \Illuminate\Log\Writer $logger
     */
    public function handle(Client $client, ProjectNormalizerInterface $normallizer, Writer $logger)
    {

        $params = $this->generateBaseParameters($this->project->id, 'content');

        $params['body'] = $normallizer->normalize($this->project);

        $indexed = $client->index($params);

        $logger->info($this->formatIndexedMessage($indexed));
    }

    /**
     * Format the log message for an indexing
     *
     * @param  array  $indexed
     *
     * @return bool
     */
    private function formatIndexedMessage(array $indexed)
    {
        return sprintf(
            'Indexed hit: %s %s (version: %d index: %s type: %s)',
            $indexed['result'],
            $indexed['_id'],
            $indexed['_version'],
            $indexed['_index'],
            $indexed['_type']
        );
    }
}
