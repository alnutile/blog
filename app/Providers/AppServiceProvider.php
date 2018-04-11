<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Aws\Rekognition\RekognitionClient;
use App\Search\SearchIndexRepository;
use App\Search\SearchIndexRepositoryInterface;
use App\Search\Indexes\DefaultIndex;
use Aws\Credentials\CredentialProvider;
use Aws\Credentials\Credentials;
use Aws\ElasticsearchService\ElasticsearchPhpHandler;
use ElasticSearcher\ElasticSearcher;
use ElasticSearcher\Environment;
use Elasticsearch\Client;
use App\Search\ProjectNormalizerInterface;
use App\Search\PostNormalizerInterface;
use App\Search\PostNormalizer;
use App\Search\ProjectNormalizer;
use Elasticsearch\ClientBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $this->app->bind(RekognitionClient::class, function () {
            $client = new RekognitionClient([
                'credentials' => [
                    'key' => config('services.aws.key'),
                    'secret' => config('services.aws.secret'),
                ],
                'region' => "us-east-1",
                "version" => "latest"
            ]);

            return $client;
        });

        $this->elasticSearchRegister();
    }

    protected function elasticSearchRegister()
    {
        //get SearchProvider core classes
        $this->app->singleton(SearchIndexRepositoryInterface::class, function () {
            $repository = new SearchIndexRepository();

            // Init with a default index.
            $repository->register(new DefaultIndex());

            return $repository;
        });

        $this->app->singleton(ElasticSearcher::class, function ($app) {
            // Create an AWS client credentials instance to sign requests with.
            $provider = CredentialProvider::fromCredentials(
                new Credentials(
                    config('elasticsearch.key'),
                    config('elasticsearch.secret')
                )
            );

            $params = [
                'hosts' => config('elasticsearch.hosts'),
            ];


            if (!config('elasticsearch.use_aws') && !\App::environment(["local", "testing"])) {
                // Create a handler for ES-AWS requests. This provides the bridge code
                // to allow signing of AWS requests but still use the ES PHP library.
                $handler = new ElasticsearchPhpHandler(config('elasticsearch.region'), $provider);
                $params['handler'] = $handler;
            }


            // Create an ElasticSearcher instance instead of an ES Client instance directly.
            // This is essentially just a wrapper around the client.

            $env = new Environment($params);

            $searcher = new ElasticSearcher($env);

            // Set indexes from repository.
            /** @var \App\Search\SearchIndexRepositoryInterface $index_repository */
            $index_repository = $app->make(SearchIndexRepositoryInterface::class);

            $indices_manager = $searcher->indicesManager();
            $indices_manager->registerIndices($index_repository->all());

            return $searcher;
        });

        $this->app->singleton(ClientBuilder::class, function ($app) {
            return ClientBuilder::create()->build();
        });

        $this->app->singleton(Client::class, function ($app) {
            return $app->make(ElasticSearcher::class)->getClient();
        });

        // Provide a default document normalizer. This can be overridden per app.
        $this->app->singleton(PostNormalizerInterface::class, function ($app) {
            return new PostNormalizer($app->make('log'));
        });

        $this->app->singleton(ProjectNormalizerInterface::class, function ($app) {
            return new ProjectNormalizer($app->make('log'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
