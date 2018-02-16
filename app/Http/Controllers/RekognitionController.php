<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;
use App\Helpers\RekognitionHelper;
use Facades\App\RekognitionService;

class RekognitionController extends Controller
{
    use RekognitionHelper;

    /**
     * @var RekognitionClient $rekognize_client
     */
    protected $rekognize_client;

    public function __construct(RekognitionClient $client)
    {
        $this->rekognize_client = $client;
    }

    public function show()
    {
        return view("rekognition.show");
    }

    public function faces(Request $request)
    {
        try {
            if (!\App::environment("testing")) {
                $this->validate($request, [
                    'image' => 'required|image'
                ]);
            }

            $name = $request->file('image')->getClientOriginalName();

            \Storage::disk('s3')->putFileAs(
                "rekognition",
                $request->file('image'),
                $name
            );
            $results = RekognitionService::facialAnalysis($name);
            return response()->json($results, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }

    public function text(Request $request)
    {
        try {
            if (!\App::environment("testing")) {
                $this->validate($request, [
                    'image' => 'required|image'
                ]);
            }

            $name = $request->file('image')->getClientOriginalName();

            \Storage::disk('s3')->putFileAs(
                "rekognition",
                $request->file('image'),
                $name
            );
            $results = RekognitionService::detectText($name);
            return response()->json($results, 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }

    public function recognizeCelebrities(Request $request)
    {
        try {
            if (!\App::environment("testing")) {
                $this->validate($request, [
                    'image' => 'required|image'
                ]);
            }

            $name = $request->file('image')->getClientOriginalName();

            \Storage::disk('s3')->putFileAs(
                "rekognition",
                $request->file('image'),
                $name
            );

            $results = $this->rekognize_client->recognizeCelebrities(
                [
                    'Image' => [
                        'S3Object' => [
                            'Bucket' => config("filesystems.disks.s3.bucket"),
                            'Name' => sprintf("rekognition/%s", $name)
                        ]
                    ]
                ]
            );

            return response()->json($this->transformCelebrityResults($results), 200);
        } catch (\Exception $e) {
            //oops
            //log and return error
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }
}
