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

class IndexPostsWithElasticSearch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elasticsearch:index-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index Posts';

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

            $client = ClientBuilder::create()->build();

            // $params = [
            //     'index' => 'default',
            //     'type' => 'post',
            //     'id' => 5555,
            //     'body' => ['testField' => 'abc']
            // ];

            //$response = $client->index($params);
            //print_r($response);

            $posts = Post::all();
            foreach ($posts as $model) {
                $this->info("Indexing post " . $model->id);
                $job = (new IndexPostJob($model));
                app(Dispatcher::class)->dispatchNow($job);
            }
        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
