<?php
namespace App\Helpers;

trait RekognitionHelper
{

    public function transformCelebrityResults($results)
    {
        $results = array_get($results, "CelebrityFaces", []);

        $results = collect($results)->map(function ($item) {
            return [
                'url' => "https://" . array_first(array_get($item, 'Urls', []), null),
                'name' => array_get($item, "Name", null),
                'confidence' => array_get($item, 'Face.Confidence')
            ];
        })->toArray();
        return $results;
    }

    public function transformFaceDetectResults($results)
    {
        $results = array_get($results, "FaceDetails", []);

        $results = collect($results)->map(function ($item) {
            return [
                'age_high' => array_get($item, 'AgeRange.High'),
                'age_low' => array_get($item, 'AgeRange.Low'),
                'smile' => array_get($item, 'Smile.Value'),
                'eyeglasses' => array_get($item, 'Eyeglasses.Value'),
                'gender' => array_get($item, 'Gender.Value'),
                'mustache' => array_get($item, 'Mustache.Value'),
                'emotions' => array_get($item, 'Emotions'),
                'confidence' => array_get($item, 'Confidence'),
            ];
        })->toArray();

        return $results;
    }

    public function transformTextResults($results)
    {
        $results = array_get($results, "TextDetections", []);

        $results = collect($results)->map(function ($item) {
            return [
                'name' => array_get($item, "DetectedText", null),
                'confidence' => array_get($item, 'Confidence')
            ];
        })->toArray();

        return $results;
    }
}
