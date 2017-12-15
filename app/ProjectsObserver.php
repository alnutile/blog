<?php namespace App;

use Illuminate\Support\Facades\Cache;

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
    }
}
