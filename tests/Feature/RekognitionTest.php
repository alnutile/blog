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

class RekognitionTest extends \BrowserKitTestCase
{
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

    public function testStartCelebrityRecognition()
    {
        $path_to_image = base_path("tests/fixtures/rekognition/barack-obama-smile.jpg");
        $name = "happy.jpg";
        \Storage::disk('s3')->putFileAs("rekognition", new File($path_to_image), $name);

        $client = \App::make(RekognitionClient::class);

        $results = $client->recognizeCelebrities(
            [
                'Image' => [
                    'S3Object' => [
                        'Bucket' => config("filesystems.disks.s3.bucket"),
                        'Name' => sprintf("rekognition/%s", $name)
                    ]
                ]
            ]
        );

        $fixture = base_path("tests/fixtures/rekognition/recognize_celeberties_results.json");

        \File::put($fixture, json_encode($results->toArray(), true));

    }

    public function testRecognizeCelebritiesApi()
    {
        $path = base_path("tests/fixtures/rekognition/happy.jpg");
        $image = new UploadedFile($path, 'happy.jpg');
        $this->json("POST", "/api/recognize/celebrities", [
            'image' => $image
        ])->assertResponseOk();
    }
}
