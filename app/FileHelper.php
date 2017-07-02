<?php


namespace App;


use App\Http\Requests\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait FileHelper
{

    public function handleFile(Request $request, $file_field_name) {
        if($request->file('photo_file_name')) {
            try {
                $contents = file_get_contents($request->file('photo_file_name')->getRealPath());

                Storage::disk("local")->put($request->file('photo_file_name')->getClientOriginalName(), $contents, 'public');

            } catch(\Exception $e) {
                Log::info("Error uploading file " . $e->getMessage());
            }
            $data['photo_file_name'] = $request->file('photo_file_name')->getClientOriginalName();
        }
    }
}