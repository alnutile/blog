<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Aws\Rekognition\RekognitionClient;

class RekognitionController extends Controller
{

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

    public function recognizeCelebrities(Request $request)
    {
        try {
            // $this->validate($request, [
            //     'image' => 'required|image'
            // ]);

            \Storage::disk('s3')->putFileAs(
                "rekognition",
                $request->file('image'),
                $request->file('image')->getClientOriginalName()
            );

            return response()->json([], 200);
        } catch (\Exception $e) {
            //oops
            //log and return error
            \Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 422);
        }

    }
}
