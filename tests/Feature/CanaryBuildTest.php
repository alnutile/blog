<?php

namespace Tests\Feature;

use App\Console\Commands\CanaryBuildCommand;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Mockery\Mock;
use TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CanaryBuildTest extends \TestCase
{

    public function setUp()
    {
        parent::setUp();

        $this->markTestIncomplete("Not mocked yet the command needs most of it pulled into a Service class so I can 
        not deal with mocking a Command class");
    }

    public function testGetResultsOfDoneJobFromTravis() {

        $client = \Mockery::mock(Client::class);

        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));

        $message = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->once()->andReturn($message);
        /** @var CanaryBuildCommand $command */
        $command = new CanaryBuildCommand($client);
        //$command = App::make(CanaryBuildCommand::class);

        $response = $command->seeIfTravisJobDone(78708065);

        $command->beginTravisWatcher($response);

        $this->assertNotNull($command->getTravisJobId());
    }

    public function testTravisTriggerJob() {

        $client = \Mockery::mock(Client::class);

        $client->shouldReceive('post')->once()->andReturn();

        /** @var CanaryBuildCommand $command */
        $command = new CanaryBuildCommand($client);
        //$command = App::make(CanaryBuildCommand::class);
        $command->triggerTravisBuild();
        //File::put(base_path('tests/fixtures/travis_response_from_starting_build.json'), $response->getBody());
    }



    public function testGettingStateFromRequestBuild()
    {
        $response = json_decode(File::get(base_path('tests/fixtures/travis_response_from_start_job.json')), true);

        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));

        /** @var CanaryBuildCommand $command */
        //$command = App::make(CanaryBuildCommand::class);
        $client = \Mockery::mock(Client::class);
        $message = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->once()->andReturn($message);
        $command = new CanaryBuildCommand($client);

        /** @var CanaryBuildCommand $command */
        $command->beginTravisWatcher($response);

        $this->assertEquals(78707660, $command->getTravisJobId());

        $this->assertEquals('passed', $command->getBuildState());
    }

    public function testingAllBuildStates()
    {
        $states = [
            'started',
            'passed',
            'booting',
            'created',
            'canceled',
            'failed',
            'errored'
        ];
        foreach($states as $state) {
            $response = json_decode(File::get(base_path('tests/fixtures/travis_response_from_start_job.json')), true);
            $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
            $body = str_replace('passed', $state, $body);
            /** @var CanaryBuildCommand $command */
            //$command = App::make(CanaryBuildCommand::class);
            $client = \Mockery::mock(Client::class);
            $message = new \GuzzleHttp\Psr7\Response(
                200, $headers =[], $body
            );
            $client->shouldReceive('get')->once()->andReturn($message);
            $command = new CanaryBuildCommand($client);
            /** @var CanaryBuildCommand $command */
            $command->beginTravisWatcher($response);
            $this->assertEquals($state, $command->getBuildState());
        }
    }


    public function testPassedAndTriesDone() {
        $response = json_decode(File::get(base_path('tests/fixtures/travis_response_from_start_job.json')), true);
        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
        $body = str_replace('passed', 'passed', $body);
        /** @var CanaryBuildCommand $command */
        //$command = App::make(CanaryBuildCommand::class);
        $client = \Mockery::mock(Client::class);
        $message = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->once()->andReturn($message);
        $mocked = \Mockery::mock('\Symfony\Component\Console\Command\Command');
        App::instance('\Symfony\Component\Console\Command\Command', $mocked);
        $command = new CanaryBuildCommand($client);
        /** @var CanaryBuildCommand $command */
        $command->beginTravisWatcher($response);

    }

    protected function testMethodNotFoundFirstTime() {

    }

    protected function testIfNotDoneShouldTryForFiveTries() {

    }

    public function testGettingResponseFromTravisAndReactingToNotDone()
    {
        //Should call to travis
        //get not done the 1st time
        //wait x seconds
        //get done the next time
        //close out

        //$response = File::get(base_path('tests/fixtures/travis_not_done.json'));

        /** @var CanaryBuildCommand $command */
        $command = App::make(CanaryBuildCommand::class);

        $command->seeIfTravisJobDone(39521);

        $this->assertEquals('finished', $command->getTravisState());

    }

    public function testOnlyWaitsForTenCycles() {

    }

    public function testingStatesFromTravis() {
        /** @var CanaryBuildCommand $command */
        $command = App::make(CanaryBuildCommand::class);
        $command->seeIfTravisJobDone(78708065);
    }
}
