<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\File;
use Aws\AwsClient;
use Aws\Rekognition\RekognitionClient;
use Illuminate\Http\UploadedFile;
use App\Helpers\RekognitionHelper;
use function GuzzleHttp\json_decode;
use Facades\App\RekognitionService;

class RekognitionTest extends \BrowserKitTestCase
{
    use RekognitionHelper;


    public function setUp()
    {
        parent::setUp();

        $this->markTestSkipped("Just playing with API");

        //$this->markTestSkipped("@WIP need to mock");
    }
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testFaceDetection()
    {
        $path_to_image = base_path("tests/fixtures/rekognition/barack-obama-smile.jpg");
        $name = "happy.jpg";
        \Storage::disk('s3')->putFileAs("rekognition", new File($path_to_image), $name);

        $client = \App::make(RekognitionClient::class);

        $results = $client->detectFaces(
            [
                'Image' => [
                    'S3Object' => [
                        'Bucket' => config("filesystems.disks.s3.bucket"),
                        'Name' => sprintf("rekognition/%s", $name)
                    ]
                ]
            ]
        );

        $fixture = base_path("tests/fixtures/rekognition/location_results.json");

        \File::put($fixture, json_encode($results->toArray(), true));
    }

    public function testMakeOCRFixture()
    {
        $path_to_image = base_path("tests/fixtures/rekognition/text-from-paper.jpg");
        $name = "happy.jpg";
        \Storage::disk('s3')->putFileAs("rekognition", new File($path_to_image), $name);

        $results = RekognitionService::detectText($name);

        $fixture = base_path("tests/fixtures/rekognition/text-from-paper.json");

        \File::put($fixture, json_encode($results, true));

    }

    public function testRecognizeCelebritiesApi()
    {
        $path = base_path("tests/fixtures/rekognition/happy.jpg");
        $image = new UploadedFile($path, 'happy.jpg');
        $this->json("POST", "/api/recognize/celebrities", [
            'image' => $image
        ])->assertResponseOk();
    }

    public function testTextApi()
    {
        RekognitionService::shouldReceive("detectText")->andReturn(['foo']);
        $path = base_path("tests/fixtures/rekognition/bookcover.jpg");
        $image = new UploadedFile($path, 'bookcover.jpg');
        $this->json("POST", "/api/recognize/text", [
            'image' => $image
        ])->assertResponseOk();
    }


    public function testFacialAnalysis()
    {

        $path_to_image = base_path("tests/fixtures/rekognition/happy.jpg");

        $name = "happy.jpg";

        \Storage::disk('s3')->putFileAs("rekognition", new File($path_to_image), $name);

        $results = RekognitionService::facialAnalysis($name);

        dd($results);
    }

    public function testVideoClient()
    {

        $path_to_image = base_path("tests/fixtures/rekognition/example_video.mp4");
        $name = "bookcover.jpg";
        \Storage::disk('s3')->putFileAs("rekognition", new File($path_to_image), $name);

        $results = RekognitionService::detectVideo($name);

        dd($results);
    }

    public function testTextClient()
    {

        $path_to_image = base_path("tests/fixtures/rekognition/bookcover.jpg");
        $name = "bookcover.jpg";
        \Storage::disk('s3')->putFileAs("rekognition", new File($path_to_image), $name);

        $results = RekognitionService::detectText($name);

        dd($results);
    }

    public function testTransformations()
    {
        $fixture = \File::get(base_path("tests/fixtures/rekognition/recognize_celeberties_results.json"));
        $fixture = json_decode($fixture, true);

        $results = $this->transformCelebrityResults($fixture);

        $this->assertNotEmpty($results);
        $this->assertCount(1, $results);
        $result = array_first($results);
        $this->assertEquals([
            "url" => "https://www.imdb.com/name/nm1682433",
            "name" => "Barack Obama",
            "confidence" => null
        ], $result);
    }


}
