<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use App\Jobs\Search\IndexPostJob;

/**
 * @codeCoverageIgnore
 * NOTE until needed ignored since not special work in here
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

        if (!\App::environment("testing")
            || !config('elasticsearch.disable_boot')) {
            dispatch(new IndexPostJob($model));
        }
    }
}
