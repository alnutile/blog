<?php


namespace App;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait FileHelper
{

    public function handleFile(Request $request, $file_field_name) {

        if($request->file($file_field_name)) {
            try {
                $contents = file_get_contents($request->file($file_field_name)->getRealPath());

                $this->imageToRightPlace($request, $file_field_name, $contents);

                return $request->file('photo_file_name')->getClientOriginalName();

            } catch(\Exception $e) {
                Log::info("Error uploading file " . $e->getMessage());
                return false;
            }
        }

        return false;
    }

    protected function imageToRightPlace(Request $request, $file_field_name, $contents) {
        if(env("APP_ENV") == 'testing' || env("APP_ENV") == 'local') {
            Storage::disk("local")
                ->put(
                    $request
                        ->file($file_field_name)
                        ->getClientOriginalName(), $contents, 'public'
                );
        } else {
            Storage::disk("s3")
                ->put(
                    $request
                        ->file($file_field_name)
                        ->getClientOriginalName(), $contents, 'public'
                );
        }
    }
}