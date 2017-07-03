<?php


namespace App;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait FileHelper
{

    public function handleFile(Request $request, $file_field_name)
    {

        if ($request->file($file_field_name)) {
            try {
                $path = $request->file($file_field_name)->getRealPath();

                $original_name = $request->file($file_field_name)->getClientOriginalName();

                $converted = $this->convertToJpg($path, $original_name);

                $this->imageToRightPlace($converted);

                return $converted['name'];
            } catch (\Exception $e) {
                Log::info("Error uploading file " . $e->getMessage());
                return false;
            }
        }

        return false;
    }

    public function convertToJpg($full_path_to_file, $original_name)
    {

        $name = File::basename($full_path_to_file);

        if (File::extension($full_path_to_file) == 'png') {
            $image = @imagecreatefrompng($full_path_to_file);

            if ($image) {
                $root = File::dirname($full_path_to_file);
                $name = str_replace('.png', '.jpg', $original_name);
                $full_path_to_file = sprintf("%s/%s", $root, $name);
                imagejpeg($image, $full_path_to_file);
            }
        } else {
            $name = $original_name;
        }

        return ['content' => file_get_contents($full_path_to_file), 'name' => $name];
    }

    protected function imageToRightPlace($converted = [])
    {
        $contents   = $converted['content'];

        $name       = $converted['name'];

        if (env("APP_ENV") == 'testing' || env('APP_ENV') == 'local') {
            Storage::disk("local")->put($name, $contents, 'public');
        } else {
            Storage::disk("s3")->put($name, $contents, 'public');
        }
    }
}
