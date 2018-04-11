<?php

namespace App\Console\Commands;

use App\Jobs\Migration\GenerateSiteRelationToHitsJobs;
use App\Jobs\Search\IndexHitJob;
use App\Post;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Log;
use App\Jobs\Search\BulkIndexHitJob;
use App\Jobs\Search\IndexPostJob;
use Elasticsearch\ClientBuilder;
use App\Project;
use App\Jobs\Search\IndexProjectJob;

class IndexProjectsWithElasticSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:index-projects';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index Projects';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $models = Project::all();
            foreach ($models as $model) {
                $this->info("Indexing project " . $model->id);
                $job = (new IndexProjectJob($model));
                app(Dispatcher::class)->dispatchNow($job);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
