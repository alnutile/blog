<?php

namespace App\Console\Commands;

use App\CanaryBuildService;
use App\Events\CanaryBuildEvent;
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
    /**
     * @var CanaryBuildService
     */
    private $buildService;


    public function __construct(CanaryBuildService $buildService)
    {
        parent::__construct();

        $this->buildService = $buildService;
    }

    public function showMessage(CanaryBuildEvent $event)
    {
        $this->info($event->message);
    }

    public function handle()
    {
        try {
            //Step 1 cause `master` to merge into the canary branch
            $this->buildService->triggerGitHubBuild();

            //Not canary and travis update
            $results = $this->buildService->triggerTravisBuild();

            $this->buildService->beginTravisWatcher(json_decode($results->getBody(), true));

            $this->info(sprintf(
                "Results from Travis Build State %d",
                $this->buildService->getTravisState()
            ));

            if ($this->buildService->getTravisState() == 'passed') {
                $this->info("Going ahead with push to master");
                /**
                 * Compare composer files
                 * Then push into master to force build if changes
                 */
                $this->buildService->forceAMasterBuildSinceCanaryBranchIsPassing();
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
}
