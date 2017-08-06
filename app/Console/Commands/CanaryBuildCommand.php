<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class CanaryBuildCommand extends Command
{
    protected $signature = 'canary-build';

    protected $description = 'Trigger a nightly test followed by a possible deploy';

    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    public function handle()
    {

        $results = $this->client->post("https://api.github.com/repos/alnutile/alsblog5/merges", [
            'headers' => [
                'X-GitHub-Media-Type' => 'application/vnd.github.v3+json',
                'Authorization' => 'token ' . env('GITHUB_TOKEN'),
            ],
            'json' => [
                'base' => 'canary-branch',
                'head' => 'master',
                'commit_message' => 'Nightly Canary Build',
            ],
        ]);

        $this->info(sprintf("Results %d", $results->getStatusCode()));
    }
}