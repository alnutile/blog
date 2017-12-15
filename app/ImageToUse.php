<?php namespace App;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageToUse
{

    public function __construct()
    {
    }
    public function exists($filename)
    {

        if (Storage::exists($filename)) {
            return config('filesystems.cdn') . "/" . $filename;
        } elseif (File::exists(public_path() . '/dist/img/' . $filename)) {
            return '/dist/img/' . $filename;
        }

        return '/img/' . $filename;
    }
}
