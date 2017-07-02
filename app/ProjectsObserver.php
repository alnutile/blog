<?php namespace App;

use Illuminate\Support\Facades\Cache;

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
