<?php

namespace App\Jobs\Search;

use App\Post;
use App\Search\HitNormalizerInterface;
use Elasticsearch\Client;
use Illuminate\Log\Writer;
use App\Search\PostNormalizerInterface;
use Elasticsearch\ClientBuilder;

class IndexPostJob extends SearchJobBase
{
    /**
     * @var \App\Post
     */
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @param \Elasticsearch\Client $client
     * @param \App\Search\PostNormalizerInterface $normallizer
     * @param \Illuminate\Log\Writer $logger
     */
    public function handle(Client $client, PostNormalizerInterface $normallizer, Writer $logger)
    {

        //$client = ClientBuilder::create()->build();

        // $params = [
        //     'index' => 'default',
        //     'type' => 'post',
        //     'id' => 5555,
        //     'body' => ['testField' => 'abc']
        // ];


        $params = $this->generateBaseParameters($this->post->id, 'post');

        $params['body'] = $normallizer->normalize($this->post);

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
