<?php namespace App\Services;

use App\ImageToUse;
use Illuminate\Support\ServiceProvider;

class ImageService extends ServiceProvider {

    public function register()
    {
        $this->app->bind('ImageToUse', function(){
            return new ImageToUse();
        });
    }

}
