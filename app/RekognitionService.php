<?php

namespace App;

use Aws\Rekognition\RekognitionClient;
use App\Helpers\RekognitionHelper;


class RekognitionService
{

    use RekognitionHelper;

    /**
     * @var RekognitionClient
     */
    protected $client;

    public function __construct(RekognitionClient $client)
    {
        $this->client = $client;
    }

    public function recognizeCelebrities($file)
    {
        $results = $this->client->recognizeCelebrities(
            [
                'Image' => [
                    'S3Object' => [
                        'Bucket' => config("filesystems.disks.s3.bucket"),
                        'Name' => sprintf("rekognition/%s", $file)
                    ]
                ]
            ]
        );

        return $this->transformCelebrityResults($results);
    }


    public function facialAnalysis($file)
    {
        $results = $this->client->detectFaces(
            [
                'Attributes' => ["ALL"],
                'Image' => [
                    'S3Object' => [
                        'Bucket' => config("filesystems.disks.s3.bucket"),
                        'Name' => sprintf("rekognition/%s", $file)
                    ]
                ]
            ]
        );

        return $this->transformFaceDetectResults($results);
    }

    public function detectText($file)
    {
        $results = $this->client->detectText(
            [
                'Image' => [
                    'S3Object' => [
                        'Bucket' => config("filesystems.disks.s3.bucket"),
                        'Name' => sprintf("rekognition/%s", $file)
                    ]
                ]
            ]
        );

        return $this->transformTextResults($results);
    }

}