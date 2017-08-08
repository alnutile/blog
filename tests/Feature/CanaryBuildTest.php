<?php

namespace Tests\Feature;

use App\Console\Commands\CanaryBuildCommand;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CanaryBuildTest extends \TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->markTestIncomplete("Not mocked yet");

    }
    public function testTravisTriggerJob() {
        /** @var CanaryBuildCommand $command */
        $command = App::make(CanaryBuildCommand::class);

        $response = $command->triggerTravisBuild();

        //File::put(base_path('tests/fixtures/travis_response_from_starting_build.json'), $response->getBody());
    }

    public function testGetResultsOfDoneJobFromTravis() {

        /** @var CanaryBuildCommand $command */
        $command = App::make(CanaryBuildCommand::class);

        $response = $command->seeIfTravisJobDone(78708065);

        //File::put(base_path('tests/fixtures/travis_response_from_done_job_with_success.json'), json_encode($response, 128));

        $command->beginTravisWatcher($response);


    }

    public function testGetStateOfStartedJobFromTravis()
    {
        $response = json_decode(File::get(base_path('tests/fixtures/travis_response_from_start_job.json')), true);

        /** @var CanaryBuildCommand $command */
        $command = App::make(CanaryBuildCommand::class);

        $command->beginTravisWatcher($response);

        $this->assertEquals(78707660, $command->getTravisJobId());
    }

    public function testGettingResponseFromTravisAndReactingToNotDone()
    {
        //$response = File::get(base_path('tests/fixtures/travis_not_done.json'));

        /** @var CanaryBuildCommand $command */
        $command = App::make(CanaryBuildCommand::class);

        $command->seeIfTravisJobDone(39521);

        $this->assertEquals('finished', $command->getTravisState());

    }
}
