<?php

namespace App\Console\Commands\Search;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use ElasticSearcher\ElasticSearcher;
use Illuminate\Console\Command;
use App\Search\PostNormalizerInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SearchCommandBase extends Command
{

    /**
     * @var ElasticSearcher
     */
    protected $searcher;

    /**
     * @var PostNormalizerInterface
     */
    protected $modelNormalizer;

    /**
     * IndexCommandBase constructor.
     *
     * @param \ElasticSearcher\ElasticSearcher $searcher
     * @param PostNormalizerInterface $hit_normalizer
     */
    public function __construct(
        ElasticSearcher $searcher,
        PostNormalizerInterface $post_normalizer
    ) {


        parent::__construct();

        $this->searcher = $searcher;
        $this->modelNormalizer = $post_normalizer;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        // Catch all ES related exceptions and print them a little nicer, if poss.
        try {
            return $this->laravel->call([$this, 'handle']);
        } catch (BadRequest400Exception $e) {
            $this->writeSearchExceptionLine($e);
        }
    }

    /**
     * @param ElasticsearchException $e
     *
     * @return string
     */
    protected function writeSearchExceptionLine(ElasticsearchException $e)
    {
        try {
            $decoded = \GuzzleHttp\json_decode($e->getMessage());
            $message = \GuzzleHttp\json_encode($decoded, JSON_PRETTY_PRINT);
        } catch (\InvalidArgumentException $json_e) {
            $message = $e->getMessage();
        }

        $this->error($message);
    }
}
