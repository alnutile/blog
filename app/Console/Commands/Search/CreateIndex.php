<?php

namespace App\Console\Commands\Search;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Elasticsearch\Common\Exceptions\ElasticsearchException;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Create index command.
 */
class CreateIndex extends SearchCommandBase
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:create-index {index}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create an index';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $index = $this->argument('index');

        $this->searcher->indicesManager()->create($index);
        $this->info(sprintf('"%s" index created', $index));
    }

    /**
     * Overridden to provide custom handling for index already exists.
     */
    protected function writeSearchExceptionLine(ElasticsearchException $e)
    {
        try {
            $decoded = \GuzzleHttp\json_decode($e->getMessage());
            $message = \GuzzleHttp\json_encode($decoded, JSON_PRETTY_PRINT);

            if (($decoded->status === 400) && (isset($decoded->error->type)
                && ($decoded->error->type === 'resource_already_exists_exception'))
            ) {
                $this->line($message);
                $this->info('Index already exists');
                return 0;
            }
        } catch (\InvalidArgumentException $json_e) {
            $message = $e->getMessage();
        }

        $this->error($message);
        return 1;
    }
}
