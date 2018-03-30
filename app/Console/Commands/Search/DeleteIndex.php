<?php

namespace App\Console\Commands\Search;

use Elasticsearch\Common\Exceptions\BadRequest400Exception;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Delete index command.
 */
class DeleteIndex extends SearchCommandBase
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:delete-index {index} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete an index';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $index = $this->argument('index');
        $force = $this->option('force');

        // Require a confirmation to continue unless --force is used.
        if (!$force && !$this->confirm('Are you sure?')) {
            return;
        }

        $this->searcher->indicesManager()->delete($index);
        $this->info(sprintf('"%s" index deleted', $index));
    }
}
