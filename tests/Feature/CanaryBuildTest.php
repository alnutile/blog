<?php

namespace Tests\Feature;

use App\CanaryBuildService;
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
    }

    public function testGetResultsOfDoneJobFromTravis() {

        $client = \Mockery::mock(Client::class);
        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
        $message = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->twice()->andReturn($message);
        /** @var CanaryBuildService $command */
        $command = new CanaryBuildService($client);
        $response = $command->seeIfTravisJobDone(78708065);

        $command->beginTravisWatcher($response);

        $this->assertNotNull($command->getTravisJobId());
    }

    public function testCallsTwiceOnceEmptyBuildThenPassed() {
        $client = \Mockery::mock(Client::class);
        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
        $body1 = json_decode($body, true);
        $body1['builds'] = [];
        $body1 = json_encode($body1);
        $message1 = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body1
        );
        $client->shouldReceive('get')->once()->andReturn($message1);
        $client->shouldReceive('get')->once()->andReturn($message1);

        $message2 = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->once()->andReturn($message2);
        /** @var CanaryBuildService $command */
        $command = new CanaryBuildService($client);
        $command->setSleep(1);
        $response = $command->seeIfTravisJobDone(78708065);

        $command->beginTravisWatcher($response);

        $this->assertNotNull($command->getTravisJobId());
    }

    public function testIfErrorDoesItStop() {
        $client = \Mockery::mock(Client::class);
        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
        $body = str_replace("passed", "errored", $body);
        $message2 = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->twice()->andReturn($message2);
        /** @var CanaryBuildService $command */
        $command = new CanaryBuildService($client);
        $command->setSleep(1);
        $response = $command->seeIfTravisJobDone(78708065);

        $command->beginTravisWatcher($response);

        $this->assertNotNull($command->getTravisJobId());

        $this->assertEquals('errored', $command->getTravisState());
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
        $command = new CanaryBuildService($client);

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
            $client->shouldReceive('get')->andReturn($message);
            $command = new CanaryBuildService($client);
            $command->setSleep(.05);
            $command->setTries(99);
            /** @var CanaryBuildCommand $command */
            $command->beginTravisWatcher($response);
            $this->assertEquals($state, $command->getBuildState());
        }
    }


    public function testPassedAndTriesDone() {
        $response = json_decode(File::get(base_path('tests/fixtures/travis_response_from_start_job.json')), true);
        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
        /** @var CanaryBuildCommand $command */
        //$command = App::make(CanaryBuildCommand::class);
        $client = \Mockery::mock(Client::class);
        $message = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $client->shouldReceive('get')->once()->andReturn($message);
        $mocked = \Mockery::mock('\Symfony\Component\Console\Command\Command');
        App::instance('\Symfony\Component\Console\Command\Command', $mocked);
        $command = new CanaryBuildService($client);
        /** @var CanaryBuildCommand $command */
        $command->beginTravisWatcher($response);

    }

    public function testReactToBuildState() {
        $response = json_decode(File::get(base_path('tests/fixtures/travis_response_from_start_job.json')), true);
        $body = File::get(base_path('tests/fixtures/travis_getting_results_using_a_request_id.json'));
        $passed = $body;
        $body = str_replace('passed', 'booting', $body);
        /** @var CanaryBuildCommand $command */
        //$command = App::make(CanaryBuildCommand::class);
        $client = \Mockery::mock(Client::class);
        $message = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $body
        );
        $message_passed = new \GuzzleHttp\Psr7\Response(
            200, $headers =[], $passed
        );
        $client->shouldReceive('get')->andReturn($message);
        $client->shouldReceive('get')->andReturn($message_passed);
        $mocked = \Mockery::mock('\Symfony\Component\Console\Command\Command');
        App::instance('\Symfony\Component\Console\Command\Command', $mocked);
        /** @var CanaryBuildService $command */
        $command = \Mockery::mock('\App\CanaryBuildService', [$client])->shouldAllowMockingProtectedMethods()
        ->makePartial();
        $command->shouldReceive('buildBooting')->once();
        /** @var CanaryBuildCommand $command */
        $command->beginTravisWatcher($response);
    }

}
