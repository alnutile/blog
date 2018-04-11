<?php namespace App;

use Illuminate\Support\Facades\Cache;
use App\Jobs\Search\IndexProjectJob;
use Illuminate\Events\Dispatcher;

/**
 * @codeCoverageIgnore
 * NOTE until needed ignored since not special work in here
 */
class ProjectsObserver
{


    public function deleted($model)
    {
        foreach (['projects', 'project'] as $value) {
            Cache::forget($value);
        }

        Cache::forget('project_' . $model->id);
    }

    public function saved($model)
    {
        foreach (['projects', 'project'] as $value) {
            Cache::forget($value);
        }

        Cache::forget('project_' . $model->id);

        if (!\App::environment("testing")
            || !config('elasticsearch.disable_boot')) {
            dispatch(new IndexProjectJob($model));
        }
    }
}
