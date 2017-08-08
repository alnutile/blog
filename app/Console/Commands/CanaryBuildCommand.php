<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\parse_header;
use GuzzleHttp\Psr7\Response;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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

    protected $sleep = 5;

    protected $tries = 1;

    /**
     * @var Client
     */
    protected $client;

    private $account_and_repo = "alnutile/alsblog5";
    private $travis_job_id;
    private $build_state;

    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    public function handle()
    {
        try {
            /** @var Response $results */
            $results = $this->triggerGitHubBuild();

            if ($results->getStatusCode() == 204) {
                $this->info(
                    sprintf(
                        "Results %d so going to manually trigger the build",
                        $results->getStatusCode()
                    )
                );
                //Well nothing to merge so just do a build anyways
                //  else it would have done it i on it's own by just merging above
                $results = $this->triggerTravisBuild();

                $this->beginTravisWatcher(json_decode($results->getBody(), true));

                $this->info(sprintf("Results from Travis %d", $results->getStatusCode()));
            }
        } catch (\Exception $e) {
            $message = sprintf(
                "Something went horribly wrong :( %s, %d, %s",
                $e->getMessage(),
                $e->getLine(),
                $e->getFile()
            );
            Log::info($message);
            $this->error($message);
        }
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
        return $this->client->post(sprintf("https://api.github.com/repos/%s/merges", $this->account_and_repo), [
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
        $id = (isset($results['request']['id'])) ? $results['request']['id'] : $results['id'];
        $this->travis_job_id = $id;
        $message = sprintf("Running for id %d try %d", $id, $this->tries);
        Log::info($message);
        $this->info($message);
        $this->seeIfHaveBuildInfoYet();
    }

    protected function seeIfHaveBuildInfoYet()
    {

        $response = $this->client->get(
            sprintf(
                "https://api.travis-ci.org/repo/%s/request/%d",
                urlencode($this->account_and_repo),
                $this->travis_job_id
            ),
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    'Travis-API-Version' => '3',
                    'Authorization' => 'token ' . env('TRAVIS_TOKEN'),
                ]
            ]
        );

        $results = json_decode($response->getBody(), true);

        if (isset($results['builds']) && !empty($results['builds'])) {
            foreach ($results['builds'] as $build) {
                $this->reactToBuild($build);
            }
        } else {
            $this->tryAgain();
        }
    }

    /**
     * @return mixed
     */
    public function getBuildState()
    {
        return $this->build_state;
    }

    /**
     * @param mixed $build_state
     */
    public function setBuildState($build_state)
    {
        $this->build_state = $build_state;
    }

    /**
     * @return int
     */
    public function getTries()
    {
        return $this->tries;
    }

    /**
     * @param int $tries
     */
    public function setTries($tries)
    {
        $this->tries = $tries;
    }

    /**
     * @param int $sleep
     */
    public function setSleep($sleep)
    {
        $this->sleep = $sleep;
    }

    /**
     * @return int
     */
    public function getSleep()
    {
        sleep($this->sleep);
    }

    protected function buildErrored($build)
    {
        $this->build_state = 'errored';
        $this->log("Errored");
        return false;
    }

    protected function log($state)
    {
        Log::info(sprintf("%s on job %d", $state, $this->travis_job_id));
    }

    protected function buildCanceled($build)
    {
        $this->build_state = 'canceled';
        $this->log("Canceled");
        return false;
    }

    protected function buildStarted($build)
    {
        $this->build_state = 'started';
        $this->log("Started");
        $this->tryAgain();
    }

    protected function buildCreated($build)
    {
        $this->build_state = 'created';
        $this->log("Created");
        $this->tryAgain();
    }

    protected function buildBooting($build)
    {
        $this->build_state = 'booting';
        $this->log("Booting");
        $this->tryAgain();
    }

    protected function buildFailed($build)
    {
        $this->build_state = 'failed';
        $this->log("Failed");
        return false;
    }

    protected function buildPassed($build)
    {
        $this->build_state = 'passed';
        $this->log("Passed!!!");
        return false;
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

    protected function triggerMergeBackIntoMaster()
    {
        Log::info("Time to merge back into master");
    }

    protected function reactToBuild($build)
    {
        $method = 'build' . ucfirst($build['state']);
        if (method_exists($this, $method)) {
            Log::info("Method " . $method);
            $this->{$method}($build);
        } else {
            Log::info("Method not found " . $method);
            $this->tryAgain();
        }
    }

    protected function tryAgain()
    {
        if ($this->tries > 100) {
            return false;
        }
        $this->tries = $this->tries + 1;
        $this->getSleep();
        $message = sprintf(
            "Try number %d for job %d state %s",
            $this->tries,
            $this->travis_job_id,
            $this->build_state
        );
        $this->info($message);
        Log::info($message);
        $this->seeIfHaveBuildInfoYet();
    }
}
