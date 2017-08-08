<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

/**
 * Class CanaryBuildCommand
 * @package App\Console\Commands
 * @codeCoverageIgnore
 * @NOTE not ready yet
 */
class CanaryBuildCommand extends Command
{
    protected $signature = 'canary-build';

    protected $description = 'Trigger a nightly test followed by a possible deploy';

    protected $travis_state = "";

    /**
     * @var Client
     */
    protected $client;

    private $account_and_repo = "alnutile/alsblog5";
    private $travis_job_id;

    public function __construct(Client $client)
    {
        parent::__construct();

        $this->client = $client;
    }

    public function handle()
    {
        /** @var Response $results */
        $results = $this->triggerGitHubBuild();

        if ($results->getStatusCode() == 204) {
            $this->info(sprintf("Results %d so going to manually trigger the build", $results->getStatusCode()));
            //Well nothing to merge so just do a build anyways
            //  else it would have done it i on it's own by just merging above
            $results = $this->triggerTravisBuild();

            $this->beginTravisWatcher(json_decode($results->getBody(), true));

            $this->info(sprintf("Results from Travis %d", $results->getStatusCode()));
        }

        $this->info(sprintf("Results from GitHub %d", $results->getStatusCode()));
    }

    public function seeIfTravisJobDone($job_id = false)
    {

        if ($job_id) {
            $results = $this->client->get(
                sprintf("https://api.travis-ci.org/repo/%s/request/%d", urlencode($this->account_and_repo), $job_id),
                [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Travis-API-Version' => '3',
                    'Authorization' => 'token ' . env('TRAVIS_TOKEN'),
                ]
                ]
            );

            $results = json_decode($results->getBody(), true);

            if (isset($results["state"])) {
                $this->setTravisState($results["state"]);
            } else {
                $this->setTravisState("ERROR");
            }

            return $results;
        }

        return false;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function triggerTravisBuild()
    {
        $results = $this->client->post(
            sprintf("https://api.travis-ci.org/repo/%s/requests", urlencode($this->account_and_repo)),
            [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Travis-API-Version' => '3',
                'Authorization' => 'token ' . env('TRAVIS_TOKEN'),
            ],
            'json' => [
                'request' => [
                    "branch" => "canary-branch"
                ]
            ],
            ]
        );

        return $results;
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function triggerGitHubBuild()
    {
        $this->client->post(sprintf("https://api.github.com/repos/%s/merges", $this->account_and_repo), [
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
    }

    public function getTravisState()
    {
        return $this->travis_state;
    }

    public function setTravisState($travis_state)
    {
        $this->travis_state = $travis_state;
    }

    public function beginTravisWatcher($results)
    {
        $this->travis_job_id = $results['request']['id'];
    }

    /**
     * @return mixed
     */
    public function getTravisJobId()
    {
        return $this->travis_job_id;
    }

    /**
     * @param mixed $travis_job_id
     */
    public function setTravisJobId($travis_job_id)
    {
        $this->travis_job_id = $travis_job_id;
    }
}
