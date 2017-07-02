<?php

namespace App;

use Illuminate\Support\Facades\Cache;

/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 5/21/15
 * Time: 10:05 PM
 */

class PostObserver
{


    public function deleted($model)
    {
        foreach (['posts_sidebar', 'posts'] as $value) {
            Cache::forget($value);
        }

        Cache::forget('post_' . $model->id);
    }

    public function saved($model)
    {
        foreach (['posts_sidebar', 'posts'] as $value) {
            Cache::forget($value);
        }

        Cache::forget('post_' . $model->id);
    }
}
